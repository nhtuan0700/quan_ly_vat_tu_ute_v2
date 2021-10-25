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
        <h5 class="text-light m-0">Nguyễn Văn A</h5>
        <p class="text-light m-0">Giảng viên</p>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#" class="nav-link" id="link-home">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Trang chủ
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>