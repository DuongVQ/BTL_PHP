<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    @include('home.header')

    <?php
    $value = 0;
    ?>
    <div class="cart_section">
        {{-- Breakcumb --}}
        <div class="mb-5">
            <a href="{{ url('/dashboard') }}" class="text-dark text-decoration-underline">Trang chủ</a> / <span
                class="text-secondary">Giỏ hàng</span>
        </div>

        {{-- Main cart --}}
        <div class="wrapper_cart mb-5">
            {{-- info product --}}
            <div class="cart_content">
                <h5 class="mb-2">Giỏ hàng của tôi</h5>
                <div class="list_cart">
                    @if (count($cart) == 0)
                        <div class="empty-cart text-center py-5">
                            <i class="fa fa-shopping-cart" style="font-size: 60px; color: #ccc;"></i>
                            <p class="mt-3 text-secondary">Giỏ hàng của bạn đang trống</p>
                        </div>
                    @else
                        @foreach ($cart as $cart)
                            <div class="item_cart d-flex mb-3">
                                <div class="item_cart-img me-3">
                                    <img src="products/{{ $cart->product->image }}" alt=""
                                        style="width:80px; height:100px; object-fit:cover;">
                                </div>
                                <div class="item_cart-price flex-grow-1">
                                    <p class="mb-1" style="width: 200px;">{{ $cart->product->title }}</p>
                                    <p class="mb-1">{{ number_format($cart->product->price * $cart->quantity) }}đ</p>
                                    <p class="mb-1">Số lượng: {{ $cart->quantity }}</p>
                                </div>
                                <form action="{{ url('remove_cart', $cart->id) }}" method="POST" class="ms-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 text-danger" style="background: transparent;"
                                        onclick="confirmation(event)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <?php $value = $value + $cart->product->price * $cart->quantity; ?>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- payment --}}
            <div class="payment">
                <h5 class="mb-2">Thanh toán đơn hàng</h5>
                <div class="form_payment">
                    <form action="{{ url('confirm_order') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Tên khách hàng:</label>
                            <input type="text" name="name" id="" value="{{ Auth::user()->name }}" />
                        </div>
                        <div class="mb-3">
                            <label for="">Số điện thoại:</label>
                            <input type="text" name="phone" id="" value="{{ Auth::user()->phone }}" />
                        </div>
                        <div class="mb-3">
                            <label for="">Địa chỉ nhận:</label>
                            <textarea type="text" name="address" id="">{{ Auth::user()->address }}</textarea>
                        </div>
                        <h5 class="d-flex justify-content-between align-items-center">Total: <span
                                class="text-danger">{{ number_format($value) }}đ</span></h5>
                        <div class="">
                            <input type="submit" value="Đặt Hàng" class="pay_by_cash" />
                            <div class="w-full text-center pay_by_stripe">
                                <a href="{{ url('stripe') }}" class="text-dark">Thanh toán online</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('home.footer')

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        function confirmation(e) {
            e.preventDefault();
            swal({
                title: "Bạn có chắc muốn xóa?",
                text: "Hành động này không thể hoàn tác!",
                icon: "warning",
                buttons: ["Hủy", "Xóa"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    e.target.closest('form').submit();
                }
            });
        }
    </script>
</body>

</html>
