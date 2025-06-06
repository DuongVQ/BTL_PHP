<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    @include('home.header')

    <div class="product_detail">
        {{-- Breakcumb --}}
        <div class="product_detail-breakcumb mb-5">
            <a href="{{ url('/dashboard') }}" class="text-dark text-decoration-underline">Trang chủ</a> / <span
                class="text-secondary">{{ $product->title }}</span>
        </div>

        {{-- info product --}}
        <div class="product_detail-info">
            <div class="product_detail-img border border-dark">
                <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            <div class="product_detail-text">
                <h3 class="mb-3">{{ $product->title }}</h3>
                <p class="mb-3">Giá: {{ number_format($product->price) }}đ</p>
                <p class="mb-3" style="font-size: 16px">Mô tả: {{ $product->description }}</p>
                <form action="{{ url('add_cart', $product->id) }}" method="POST" class="add-cart-form">
                    @csrf
                    <p>Số lượng: </p>
                    <div class="adjust-quantity mb-4 d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-qty"
                            onclick="changeQty(this, -1)">-</button>
                        <input type="number" name="quantity" class="form-control text-center" value="1"
                            min="1" style="width:60px;" readonly>
                        <button type="button" class="btn btn-outline-secondary btn-qty"
                            onclick="changeQty(this, 1)">+</button>
                    </div>
                    <div class="btns-product">
                        <button type="submit" class="btn-add-cart w-100">
                            Thêm vào giỏ
                        </button>
                    </div>
                </form>

                <form action="{{ url('add_cart', $product->id) }}" method="POST"
                    onsubmit="document.getElementById('buy-now-type').value='buy_now';">
                    @csrf
                    <input type="hidden" name="quantity" id="buy-now-qty" value="1">
                    <input type="hidden" name="type" id="buy-now-type" value="buy_now">
                    <button type="submit" class="btn btn-outline-dark rounded-0 w-100 mt-2"
                        onclick="syncBuyNowQty()">Mua ngay</button>
                </form>

            </div>
        </div>
    </div>

    <!-- info section -->
    @include('home.footer')

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
