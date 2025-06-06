<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    @include('home.header')

    <div class="order_section container">
        <table class="table text-center">
            <tr>
                <th class="border-0">ID</th>
                <th class="border-0">Sản phẩm</th>
                <th class="border-0">Số lượng</th>
                <th class="border-0">Đơn giá</th>
                <th class="border-0">Hình ảnh</th>
                <th class="border-0">Trạng thái</th>
            </tr>
            
            @foreach ($data as $data)
                <tr>
                    <td class="">{{ $data->id }}</td>
                    <td class="">{{ $data->product->title }}</td>
                    <td class="">{{ $data->quantity }}</td>
                    <td class="">{{ $data->product->price }}</td>
                    <td class="">
                        <img src="products/{{ $data->product->image }}" width="100" height="120"
                            style="object-fit: cover;" alt="" class="border">
                    </td>
                    <td class="">
                        @php
                            $status = $data->status;
                            $bg = match ($status) {
                                'Chờ xử lý' => 'bg-warning text-dark',
                                'Đang giao' => 'bg-primary text-white',
                                'Hoàn thành' => 'bg-success text-white',
                                'Hủy' => 'bg-danger text-white',
                                default => 'bg-secondary text-white',
                            };
                        @endphp
                        <div class="px-3 py-1 rounded-pill w-75 mx-auto {{ $bg }}" style="font-size: 12px">
                            {{ $status }}
                        </div>
                        @if ($status == 'Chờ xử lý')
                            <form action="{{ url('cancel_order/' . $data->id) }}" method="POST" class="d-inline ms-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger mt-2 px-3 rounded-pill"
                                    style="font-size: 12px" onclick="return confirm('Bạn chắc chắn muốn hủy đơn này?')">
                                    <i class="fa fa-trash"></i>
                                    Hủy đơn
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @include('home.footer')

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
