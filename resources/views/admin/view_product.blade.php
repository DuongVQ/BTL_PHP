<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    @flasher_render
</head>

<body>
    <!-- Header -->
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 class="text-white">Danh sách sản phẩm</h1>
                <form action="{{url('product_search')}}" method="GET" class="d-flex" style="gap: 20px;">
                    @csrf
                    <input type="search" name="search" placeholder="Tìm kiếm sản phẩm..." class="form-control text-white border-white">
                    <input type="submit" value="Tìm kiếm" class="btn btn-primary">
                </form>
                <div class="border mt-3">
                    <table class="table table_deg text-center">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Tên sản phẩm</th>
                            <th class="text-white">Mô tả</th>
                            <th class="text-white">Giá</th>
                            <th class="text-white">Số lượng</th>
                            <th class="text-white">Danh mục</th>
                            <th class="text-white">Ảnh</th>
                            <th class="text-white">Thao tác</th>
                        </tr>
                        @foreach ($data as $product)
                            <tr>
                                <td class="text-white">{{ $product->id }}</td>
                                <td class="text-white">{{ $product->title }}</td>
                                <td class="text-white">{!!Str::limit($product->description, 20) !!}</td>
                                <td class="text-white">{{ number_format($product->price) }}</td>
                                <td class="text-white">{{ $product->quantity }}</td>
                                <td class="text-white">{{ $product->category }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="products/{{ $product->image }}" width="100" height="120" style="object-fit: cover;">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('update_product', $product->id) }}">
                                        <button class="btn btn-info">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <a href="{{ url('delete_product', $product->id) }}" onclick="confirmation(event)">
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mt-5">
                    {{ $data->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function confirmation(e) {
            e.preventDefault();
            var url = e.currentTarget.getAttribute('href');
            swal({
                title: "Bạn có chắc muốn xóa?",
                text: "Hành động này không thể hoàn tác!",
                icon: "warning",
                buttons: ["Hủy", "Xóa"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>

</html>
