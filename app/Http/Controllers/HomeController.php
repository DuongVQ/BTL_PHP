<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session;

class HomeController extends Controller
{
    // handle thống kê bên admin
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status', 'completed')->get()->count();
        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }

    // trang chủ client
    public function home()
    {
        $products = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('products', 'count'));
    }

    // lấy thông tin user, cart
    public function login_home()
    {
        $products = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('products', 'count'));
    }

    // page xem chi tiết sản phẩm
    public function product_detail($id)
    {
        $product = Product::find($id);
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.product_detail', compact('product', 'count'));
    }

    // handle thêm vào giỏ hàng
    public function add_cart(Request $request, $id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $quantity = $request->input('quantity', 1);

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $cart = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cart) {
            // Nếu đã có thì tăng số lượng
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            // Nếu chưa có thì tạo mới
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product_id;
            $data->quantity = $quantity;
            $data->save();
        }

        if ($request->input('type') == 'buy_now') {
            return redirect('mycart');
        }
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // handle xóa sản phẩm khỏi giỏ
    public function remove_cart($id)
    {
        Cart::destroy($id);
        return redirect()->back();
    }

    // page cart 
    public function mycart()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
            $cart = Cart::where('user_id', $user_id)->get();
        } else {
            $count = '';
            $cart = '';
        }
        return view('home.mycart', compact('count', 'cart'));
    }

    // handle xác nhận đặt hàng
    public function confirm_order(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;

        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();

        foreach ($cart as $carts) {
            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $user_id;
            $order->product_id = $carts->product_id;
            $order->quantity = $carts->quantity;
            $order->save();
        }
        $cart_remove = Cart::where('user_id', $user_id)->get();
        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id);
            $data->delete();
        }
        return redirect()->back();
    }

    // page đơn hàng của tôi
    public function myorders()
    {
        $data = Order::paginate(5);
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
            $cart = Cart::where('user_id', $user_id)->get();
        } else {
            $count = '';
            $cart = '';
        }
        return view('home.order', compact('count', 'cart', 'data'));
    }

    // handle hủy đơn hàng
    public function cancel_order($id)
    {
        $order = Order::find($id);
        if ($order && $order->status == 'Chờ xử lý') {
            $order->status = 'Hủy';
            $order->save();
        }
        return redirect()->back();
    }

    // page stripe
    public function stripe()
    {
        return view('home.stripe');
    }

    // handle stripe
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        Session::flash('success', 'Payment successful!');
        return back();
    }

    // page shop - all sản phẩm
    public function shop(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();

        // Lọc theo tìm kiếm
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Lọc theo tên danh mục
        if ($request->category) {
            $cat = Category::find($request->category);
            if ($cat) {
                $query->where('category', $cat->category_name);
            }
        }

        // Lọc theo giá
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sắp xếp
        if ($request->sort == 'price_asc') {
            $query->orderBy('price');
        } elseif ($request->sort == 'price_desc') {
            $query->orderByDesc('price');
        } elseif ($request->sort == 'name_asc') {
            $query->orderBy('title');
        } elseif ($request->sort == 'name_desc') {
            $query->orderByDesc('title');
        }

        $count = 0;
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->sum('quantity');
        }

        $products = $query->paginate(12);

        return view('home.shop', compact('products', 'categories', 'count'));
    }

    // handle cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        if ($request->action == 'increase') {
            $cart->quantity += 1;
        } elseif ($request->action == 'decrease' && $cart->quantity > 1) {
            $cart->quantity -= 1;
        }
        $cart->save();
        return back();
    }

    // handle xóa sản phẩm khỏi cart
    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();
        return back();
    }
}
