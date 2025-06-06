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
                <div class="header d-flex align-items-center justify-content-between w-full">
                    <h1 class="text-white">Quản lý đơn hàng</h1>
                    <div class="d-flex align-items-center gap-2">
                        <button onclick="window.print()" class="btn btn-primary" style="margin-right: 15px;">
                            <i class="fa fa-print"></i> In đơn hàng
                        </button>
                        <a href="{{ url('admin/orders/pdf') }}" class="btn btn-info">
                            <i class="fa fa-file-pdf-o"></i> Tải PDF
                        </a>
                    </div>
                </div>
                <div class="border mt-3">
                    <table class="table table_deg text-center">
                        <tr>
                            <th class="text-white">ID</th>
                            <th class="text-white">Tên khách hàng</th>
                            <th class="text-white">Địa chỉ nhận</th>
                            <th class="text-white">Điện thoại</th>
                            <th class="text-white">Sản phẩm</th>
                            <th class="text-white">Giá</th>
                            <th class="text-white">Hình ảnh</th>
                            <th class="text-white">Trạng thái</th>
                        </tr>
                        @foreach ($data as $data)
                            <tr>
                                <td class="text-white">{{ $data->id }}</td>
                                <td class="text-white">{{ $data->name }}</td>
                                <td class="text-white">{!! Str::limit($data->rec_address, 20) !!}</td>
                                <td class="text-white">{{ $data->phone }}</td>
                                <td class="text-white">{{ $data->product->title }}</td>
                                <td class="text-white">{{ $data->product->price }}</td>
                                <td class="text-white">
                                    <img src="products/{{ $data->product->image }}" width="100" height="120" style="object-fit: cover"
                                        alt="">
                                </td>
                                <td class="text-white">
                                    <form action="{{ url('admin/update_order_status/' . $data->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" style="border-radius: 6px;"
                                            class="form-control form-control-sm border-0
                                                {{ $data->status == 'pending' ? 'bg-warning text-dark' : '' }}
                                                {{ $data->status == 'shipping' ? 'bg-info text-white' : '' }}
                                                {{ $data->status == 'completed' ? 'bg-success text-white' : '' }}
                                                {{ $data->status == 'cancelled' ? 'bg-danger text-white' : '' }}">
                                            <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                            <option value="shipping" {{ $data->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                            <option value="completed" {{ $data->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                            <option value="cancelled" {{ $data->status == 'cancelled' ? 'selected' : '' }}>Hủy</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{-- <div class="mt-5">
                    {{ $data->links() }}
                </div> --}}
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
