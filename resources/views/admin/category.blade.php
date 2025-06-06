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
                <h1 class="text-white">Quản lý danh mục</h1>
                <div class="div_deg d-flex align-items-center justify-center my-3">
                    <form action="{{ url('add_category') }}" method="POST" class="w-100">
                        @csrf
                        @if (isset($editCategory))
                            <input type="hidden" name="id" value="{{ $editCategory->id }}">
                        @endif
                        <div class="w-100 d-flex" style="gap: 10px">
                            <input type="text" name="category" class="p-2 w-100 form-control border-white text-white" placeholder="Nhập tên danh mục..."
                                value="{{ isset($editCategory) ? $editCategory->category_name : '' }}">
                            <input type="submit" value="{{ isset($editCategory) ? 'Cập nhật' : 'Thêm danh mục' }}"
                                class="btn btn-primary rounded-0">
                        </div>
                    </form>
                </div>

                <div class="border mt-3">
                    <table class="table table_deg text-center">
                        <tr>
                            <th class="text-white">Mã danh mục</th>
                            <th class="text-white">Tên danh mục</th>
                            <th class="text-white">Trạng thái</th>
                        </tr>
                        @foreach ($data as $data)
                            <tr>
                                <td class="text-white">{{ $data->id }}</td>
                                <td class="text-white">{{ $data->category_name }}</td>
                                <td class="text-white">
                                    <a href="{{ url('view_category', $data->id) }}" class="btn btn-info">Cập nhật</a>
                                    <a href="{{ url('delete_category', $data->id) }}" onclick="confirmation(event)" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
