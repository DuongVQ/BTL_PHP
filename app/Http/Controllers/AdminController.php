<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    // page danh mục
    public function view_category($id = null)
    {
        $data = Category::all();
        $editCategory = null;
        if ($id) {
            $editCategory = Category::find($id);
        }
        return view('admin.category', compact('data', 'editCategory'));
    }

    // handle thêm danh mục
    public function add_category(Request $request)
    {
        if ($request->id) {
            // Update
            $category = Category::find($request->id);
            $category->category_name = $request->category;
            $category->save();
            toastr()->closeButton()->addSuccess('Category Updated Successfully!');
        } else {
            // Add new
            $category = new Category();
            $category->category_name = $request->category;
            $category->save();
            toastr()->closeButton()->addSuccess('Category Added Successfully!');
        }
        return redirect('view_category');
    }

    // handle xóa danh mục
    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        toastr()->closeButton()->addSuccess('Category Deleted Successfully!');
        return redirect()->back();
    }

    // page xem chi tiết sản phẩm
    public function view_product($id = null)
    {
        $data = Product::paginate(5);
        return view('admin.view_product', compact('data'));
    }

    // page thêm sản phẩm
    public function add_product()
    {
        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }

    // handle thêm sản phẩm
    public function upload_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imageName);
            $data->image = $imageName;
        }

        $data->save();
        toastr()->closeButton()->addSuccess('Thêm sản phẩm thành công!');
        return redirect('/add_product');
    }

    // handle xóa sản phẩm
    public function delete_product($id) 
    {
        $data = Product::find($id);
        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)) {
            unlink($image_path);
        }
        $data->delete();
        toastr()->closeButton()->addSuccess('Category Deleted Successfully!');
        return redirect()->back();
    }

    // page cập nhật sản phẩm
    public function update_product($id) 
    {
        $data = Product::find($id);
        $category = Category::all();
        return view('admin.update_product', compact('data', 'category'));
    }

    // handle cập nhật sản phẩm
    public function edit_product(Request $request, $id) 
    {
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imageName);
            $data->image = $imageName;
        }
        $data->save();
        toastr()->closeButton()->addSuccess('Thêm sản phẩm thành công!');
        return redirect('/view_product');
    }

    // hanlde tìm kiếm sản phẩm
    public function product_search(Request $request) 
    {
        $search = $request->search;
        $data = Product::where('title', 'LIKE', '%'.$search.'%')->paginate(5);
        return view('admin.view_product', compact('data'));

    }

    // page quản lý đơn hàng
    public function view_orders()
    {
        $data = Order::all();
        return view('admin.orders', compact('data'));
    }

    // handle cập nhật trạng thái đơn hàng
    public function update_order_status(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    // hanlde tải pdf
    public function orders_pdf()
    {
        $data = Order::with('product')->get();
        $pdf = Pdf::loadView('admin.orders_pdf', compact('data'));
        return $pdf->download('orders.pdf');
    }
}
