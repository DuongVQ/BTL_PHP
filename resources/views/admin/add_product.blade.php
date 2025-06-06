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
                <h1 class="text-white mb-3">Thêm sản phẩm</h1>
                <div class="">
                    <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-white">Tên sản phẩm</label>
                            <input type="text" name="title" class="form-control text-white" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Mô tả</label>
                            <textarea name="description" class="form-control text-white" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Giá</label>
                            <input type="number" name="price" class="form-control text-white" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Số lượng</label>
                            <input type="number" name="quantity" class="form-control text-white" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Danh mục</label>
                            <select name="category" class="form-control" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Ảnh sản phẩm</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{url('view_product')}}" class="btn btn-primary">Quay lại</a>
                            <button type="submit" class="btn btn-info" style="margin-left: 15px">Thêm sản phẩm</button>
                        </div>
                    </form>
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
</body>

</html>
