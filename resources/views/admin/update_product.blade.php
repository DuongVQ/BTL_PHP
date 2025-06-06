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
                <h1 class="text-white mb-3">Sửa sản phẩm</h1>
                <div class="">
                    <form action="{{ url('edit_product', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-white">Tên sản phẩm</label>
                            <input type="text" name="title" class="form-control text-white"
                                value="{{ $data->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Mô tả</label>
                            <textarea name="description" class="form-control text-white" rows="3" required>{{ $data->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Giá</label>
                            <input type="number" name="price" class="form-control text-white"
                                value="{{ $data->price }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Số lượng</label>
                            <input type="number" name="quantity" class="form-control text-white"
                                value="{{ $data->quantity }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Danh mục</label>
                            <select name="category" class="form-control" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->category_name }}"
                                        {{ $data->category == $cat->category_name ? 'selected' : '' }}>
                                        {{ $cat->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Ảnh sản phẩm hiện tại</label><br>
                            <img src="/products/{{ $data->image }}" width="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Chọn ảnh mới (nếu muốn thay đổi)</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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
