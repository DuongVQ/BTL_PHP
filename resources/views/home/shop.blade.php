<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    <!-- header section strats -->
    @include('home.header')

    <div class="wrapper_shop">
        <div class="product_detail-breakcumb mt-3 mb-5">
            <a href="{{ url('/dashboard') }}" class="text-dark text-decoration-underline">Trang chủ</a> / <span
                class="text-secondary">Shop</span>
        </div>

        <div class="shop_page">
            <!-- Sidebar bộ lọc -->
            <div class="filter-product">
                <form method="GET" action="{{ url('shop') }}">
                    <h5 class="mb-3">Danh mục</h5>
                    <ul class="mb-4 list-unstyled">
                        <li class="{{ request('category') ? '' : 'active' }}">
                            <a href="{{ url('shop') }}" class="text-dark">Tất cả</a>
                        </li>
                        @foreach ($categories as $cat)
                            <li class="{{ request('category') == $cat->id ? 'active' : '' }}">
                                <a href="{{ url('shop') . '?' . http_build_query(array_merge(request()->except('category'), ['category' => $cat->id])) }}"
                                    class="text-dark {{ request('category') == $cat->id ? 'text-decoration-underline' : '' }}">
                                    {{ $cat->category_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h5 class="mb-3">Lọc theo giá</h5>
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <input type="number" name="min_price" class="form-control shadow-none" placeholder="Giá từ"
                            value="{{ request('min_price') }}">
                        <span class="mx-2">-</span>
                        <input type="number" name="max_price" class="form-control shadow-none" placeholder="Đến"
                            value="{{ request('max_price') }}">
                    </div>

                    <h5 class="mb-3">Sắp xếp theo</h5>
                    <select name="sort" class="form-select mb-3">
                        <option value="">-- Chọn --</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá thấp đến
                            cao
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá cao đến
                            thấp</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Tên Z-A
                        </option>
                    </select>
                    <button type="submit" class="btn btn-dark rounded-0 w-100">Lọc sản phẩm</button>
                </form>
            </div>

            <!-- Hiển thị sản phẩm -->
            <div class="show-product">
                <div class="mb-3">
                    {{ $products->total() }} sản phẩm
                </div>
                <div class="list-product">
                    @forelse($products as $product)
                        <div class="product-item">
                            <a href="{{ url('product_detail/' . $product->id) }}" class="text-decoration-none">
                                <img src="{{ asset('products/' . $product->image) }}"
                                    alt="{{ $product->title }}">
                                <div class="">
                                    <h6 class="mt-3 mb-2 text-center text-decoration-none text-dark ">{{ $product->title }}</h6>
                                    <p class="mb-0 text-center text-decoration-none text-dark">{{ number_format($product->price) }}đ</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">Không có sản phẩm phù hợp</div>
                    @endforelse
                </div>
                {{-- Phân trang nếu có --}}
                <div class="d-flex justify-content-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- info section -->
    @include('home.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
