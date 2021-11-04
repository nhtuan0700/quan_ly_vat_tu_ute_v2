<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">

  <!-- Sidebar -->
  <div class="sidebar mt-0">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
        <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        {{-- <a href="#" class="d-block">{{ Auth::user()->role->name }}</a> --}}
        <h5 class="text-light m-0">{{ auth()->user()->name }}</h5>
        <p class="text-light m-0">{{ auth()->user()->role->name }}</p>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('index') }}" class="nav-link" id="link-home">
            <p>
              Trang chủ
            </p>
          </a>
        </li>
        {{-- Người dùng --}}
        @can('user-manage')
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link" id="link-user">
              <p>
                Quản lý người dùng
              </p>
            </a>
          </li>
        @endcan
        {{-- Vật tư --}}
        @can('vattu-manage')
        <li class="nav-item">
          <a href="#" class="nav-link" id="link-vat-tu">
            <p>
              Quản lý vật tư
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('vanphongpham.index') }}" class="nav-link" id="link-van-phong-pham">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Văn phòng phẩm
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('thietbi.index') }}" class="nav-link" id="link-thiet-bi">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Thiết bị
                </p>
              </a>
            </li>
          </ul>
        </li>
        @endcan

        @can('dk-manage')
          <li class="nav-item">
            <a href="{{ route('dotdangky.index') }}" class="nav-link" id="link-dot-dang-ky">
              <p>
                Quản lý đợt đăng ký mua văn phòng phẩm
              </p>
            </a>
          </li>
        @endcan
      </ul>
    </nav>
  </div>
</aside>