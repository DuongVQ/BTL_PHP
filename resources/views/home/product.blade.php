<section class="shop_section layout_padding mt-5">
    <div class="container">
        <div class="heading_container heading_center">
            <h2 class="text-center d-flex align-items-center justify-content-center">
                <div class="line"></div>
                Bán chạy nhất
                <div class="line"></div>
            </h2>
        </div>

        {{-- list prouduct bestseller --}}
        <div class="list-product row">
            @foreach ($products->take(4) as $product)
                <div class="item-product col-md-3 mb-4 h-100">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                        data-bs-target="#productModal{{ $product->id }}">
                        <div class="img-product">
                            <img src="products/{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="content-product">
                            <h5 class="title-product mt-3">{{ $product->title }}</h5>
                            <p class="price">{{ number_format($product->price) }}đ</p>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
                    aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title d-none" id="productModalLabel{{ $product->id }}">
                                    {{ $product->title }}
                                </h5>
                                <div class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</div>
                            </div>
                            <div class="modal-body">
                                <img src="products/{{ $product->image }}" class="img-fluid mb-3"
                                    alt="{{ $product->title }}">
                                <div class="info-product">
                                    <p class="name-product mb-4">{{ $product->title }}</p>
                                    <p class="price-product mb-4">Giá: {{ number_format($product->price) }}đ</p>
                                    <p class="desc-product mb-4 text-justify">Mô tả: {{ $product->description }}</p>
                                    <form action="{{ url('add_cart', $product->id) }}" method="POST"
                                        class="add-cart-form">
                                        @csrf
                                        <p>Số lượng: </p>
                                        <div class="adjust-quantity mb-4 d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-outline-secondary btn-qty"
                                                onclick="changeQty(this, -1)">-</button>
                                            <input type="number" name="quantity" class="form-control text-center"
                                                value="1" min="1" style="width:60px;" readonly>
                                            <button type="button" class="btn btn-outline-secondary btn-qty"
                                                onclick="changeQty(this, 1)">+</button>
                                        </div>
                                        <div class="btns-product">
                                            <button type="submit" class="btn-add-cart w-100">
                                                Thêm vào giỏ
                                            </button>
                                            <a href="{{ url('product_detail', $product->id) }}">Xem chi tiết</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="under-best">
            <div class="under-best-left p-100px text-center">
                <h3>Cozy Sophistication</h3>
                <p>I'm a paragraph. Click here to add your own text and edit me. Let your users get to know you.</p>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="btn-under-best mb-4">Shop Furniture</div>
                </a>
                <img src="{{ asset('/images/under-best1.avif') }}" alt="">
            </div>
            <div class="bulk"></div>
            <div class="under-best-right p-100px text-center">
                <img src="{{ asset('/images/under-best2.avif') }}" alt="">
                <h3 class="mt-4">House Visit: Jane Levi</h3>
                <p>I'm a paragraph. Click here to add your own text and edit me. Let your users get to know you.</p>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="btn-under-best">Read Story</div>
                </a>
            </div>
        </div>

        <div class="brand">
            <div class="brand-title">
                <h2>Brands & Designers</h2>
            </div>
            <div class="brand-list">
                <div class="brand-item">
                    <img src="{{ asset('/images/brand1.avif') }}" alt="">
                </div>
                <div class="brand-item">
                    <img src="{{ asset('/images/brand2.avif') }}" alt="">
                </div>
                <div class="brand-item">
                    <img src="{{ asset('/images/brand3.avif') }}" alt="">
                </div>
                <div class="brand-item">
                    <img src="{{ asset('/images/brand4.avif') }}" alt="">
                </div>
                <div class="brand-item">
                    <img src="{{ asset('/images/brand5.avif') }}" alt="">
                </div>
            </div>
        </div>

        <div class="home-decor">
            <h2 class="text-center my-5">#DecorAtHome</h2>
            <div class="wrapper-imgs">
                <div class="home-decor-list">
                    <div class="item">
                        <img src="{{ asset('/images/home1.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home2.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home3.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home11.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home9.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home10.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                </div>
                <div class="home-decor-list">
                    <div class="item">
                        <img src="{{ asset('/images/home12.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home4.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home5.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home6.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home7.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('/images/home8.png') }}" alt="" loading="lazy">
                        <div class="overload">
                            #Home_decor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
