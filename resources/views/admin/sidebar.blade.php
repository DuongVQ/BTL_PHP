<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <a href="{{ url('admin/dashboard') }}" style="width: 100%">
                <img src="{{ asset('/admincss/img/logo-dark.png') }}" alt=""
                    style="width: 100%; height: 100px; object-fit: cover;">
            </a>
        </div>

        <!-- Sidebar Navidation Menus-->
        <ul class="list-unstyled">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"></i>Trang chủ</a></li>
            <li class="{{ Request::is('view_category') ? 'active' : '' }}"><a href="{{ url('view_category') }}"> <i class="fa fa-tags"></i>Danh mục</a></li>
            <li class="{{ Request::is('view_product') || Request::is('add_product') ? 'active' : '' }}"><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                        class="fa fa-cube"></i>Sản phẩm</a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li class="{{ Request::is('view_product') ? 'active' : '' }}"><a href="{{ url('view_product') }}">Danh sách sản phẩm</a></li>
                    <li class="{{ Request::is('add_product') ? 'active' : '' }}"><a href="{{ url('add_product') }}">Thêm sản phẩm</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('view_orders') ? 'active' : '' }}"><a href="{{url('view_orders')}}"> <i class="icon-padnote"></i>Orders </a></li>
            <li><a href="{{url('/dashboard')}}"> <i class="icon-logout"></i>Login page </a></li>
        </ul>
    </nav>
