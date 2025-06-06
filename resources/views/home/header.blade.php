<header class="header_section">
    {{-- running para --}}
    <div class="header_wrapper-para">
        <ul class="header_para">
            <li>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry
            </li>
            <li>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry
            </li>
            <li>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry
            </li>
        </ul>
    </div>

    {{-- header_main --}}
    <div class="header_main">
        {{-- logo --}}
        <div class="logo cursor-pointer">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('/images/logo.png') }}" alt="">
            </a>
        </div>

        {{-- menu --}}
        <div class="header_menu">
            {{-- navbar --}}
            <div class="header-nav">
                <div class="header-nav-item">
                    <a class="header-nav-link" href="{{ url('/shop') }}">Shop</a>
                </div>
                <div class="header-nav-item">
                    <a class="header-nav-link" href="{{ url('/shop?category=12') }}">Nội thất</a>
                </div>
                <div class="header-nav-item">
                    <a class="header-nav-link" href="{{ url('/shop?category=13') }}">Chiếu sáng</a>
                </div>
                <div class="header-nav-item">
                    <a class="header-nav-link" href="{{ url('/shop?category=14') }}">Thảm lau</a>
                </div>
                <div class="header-nav-item">
                    <a class="header-nav-link" href="{{ url('/') }}">Thông tin</a>
                </div>
                <div class="header-nav-item">
                    <a class="header-nav-link" href="{{ url('/') }}">Liên hệ</a>
                </div>
            </div>

            {{-- user option --}}
            <div class="user_option">
                {{-- search --}}
                <div class="search">
                    <div class="icon" onclick="toggleSearchSidebar()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <!-- Sidebar tìm kiếm -->
                <div id="searchSidebar" class="search-sidebar hide">
                    <div class="bg-white shadow w-8 border px-5 py-4" style="margin:40px auto; position:relative;">
                        <button type="button" class="btn-close border-0 bg-white" aria-label="Close"
                            style="position:absolute; top:0px; right:10px; outline: none;"
                            onclick="toggleSearchSidebar()">
                            &times;</button>
                        <form action="{{ url('shop') }}" method="GET" class="d-flex border border-dark">
                            <input type="text" name="search" class="me-2 rounded-0 border-0 px-3"
                                placeholder="Tìm kiếm sản phẩm..." style="outline: none" autofocus>
                            <button type="submit" class="btn btn-dark rounded-0 px-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- cart --}}
                <div class="cart">
                    <div class="icon" onclick="toggleCartSidebar()">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    @if (!empty($count))
                        <span class="total-product">
                            {{ $count }}
                        </span>
                    @endif
                </div>
                <!-- Sidebar Cart -->
                <div id="cartSidebar" class="cart-sidebar hide">
                    <div class="cart-sidebar-content bg-white shadow p-3"
                        style="width:400px; height:100vh; position:fixed; top:0; right:0; z-index:10000;">
                        <button type="button" class="btn-close border-0" aria-label="Close"
                            style="position:absolute; top:17px; right:17px; outline: none; background: transparent;"
                            onclick="toggleCartSidebar()">&times;</button>
                        <h5 class="mb-4 pb-2" style="border-bottom: 1px solid var(--primary-color)">Giỏ hàng</h5>
                        {{-- Nội dung giỏ hàng, ví dụ: --}}
                        @if (!empty($cartSidebar) && count($cartSidebar))
                            <?php
                            $value = 0;
                            ?>
                            <ul class="list-unstyled mb-auto" style="max-height: 490px; overflow-y: auto;">
                                @foreach ($cartSidebar as $item)
                                    <li class="mb-3 d-flex" style="line-height: normal; gap: 10px;">
                                        <img src="{{ asset('products/' . $item->product->image) }}" width="70"
                                            height="90" class="border" style="object-fit:cover;">
                                        <div style="flex:1;">
                                            <div class="mb-1">{{ $item->product->title }}</div>
                                            <div
                                                class="mb-1 text-muted small d-flex align-items-center justify-content-between gap-2">
                                                Số lượng:
                                                <form action="{{ url('cart/update/' . $item->id) }}" method="POST"
                                                    class="d-inline-flex align-items-center" style="gap:4px;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" name="action" value="decrease"
                                                        class="btn btn-sm btn-outline-secondary px-2 py-0">-</button>
                                                    <input type="text" name="quantity" value="{{ $item->quantity }}"
                                                        readonly
                                                        style="width:32px; text-align:center; border:none; background:transparent;">
                                                    <button type="submit" name="action" value="increase"
                                                        class="btn btn-sm btn-outline-secondary px-2 py-0">+</button>
                                                </form>
                                                <form action="{{ url('cart/delete/' . $item->id) }}" method="POST"
                                                    class="d-inline ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2 py-0 bg-white border-0"
                                                        onclick="confirmation(event)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div>{{ number_format($item->product->price * $item->quantity) }}đ</div>
                                            <?php $value += $item->product->price * $item->quantity; ?>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="pt-3" style="border-top: 1px solid var(--primary-color)">
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    Tổng tiền:
                                    <span>{{ number_format($value) }}đ</span>
                                </div>
                                <a href="{{ url('mycart') }}" class="btn btn-dark rounded-0 w-100 mt-3">Xem chi tiết
                                    giỏ hàng</a>
                            </div>
                        @else
                            <div class="text-center text-muted py-5">Giỏ hàng trống</div>
                        @endif
                    </div>
                </div>

                {{-- login/out --}}
                <div class="user-action">
                    <div class="icon-user icon">
                        <i class="fa-solid fa-circle-user"></i>
                    </div>
                    <div class="user-login">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('mycart') }}" class="d-flex align-items-center py-2 px-3 border-bottom">
                                    <div class="icon justify-content-start">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>
                                    Giỏ hàng của tôi
                                </a>
                                <a href="{{ url('myorders') }}"
                                    class="d-flex align-items-center py-2 px-3 border-bottom">
                                    <div class="icon justify-content-start">
                                        <i class="fa-solid fa-box-archive"></i>
                                    </div>
                                    Đơn hàng của tôi
                                </a>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="d-flex align-items-center py-2 px-3"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="icon justify-content-start">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </div>
                                    Đăng xuất
                                </a>
                            @else
                                <a href="{{ url('/login') }}" class="d-flex align-items-center p-2 border-bottom">
                                    <div class="icon">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                                    </div>
                                    Đăng nhập
                                </a>
                                <a href="{{ url('/register') }}" class="d-flex align-items-center p-2">
                                    <div class="icon">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    </div>
                                    Đăng ký
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
