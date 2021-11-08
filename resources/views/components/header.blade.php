<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav d-flex align-items-center">
    <li class="nav-item">
      <a class="nav-link" id="pushmenu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li>
      <div class="d-flex align-items-center pl-2 pr-2">
        <img src="{{ asset('img/logo.png') }}" alt="" width="38px">
        <h2 class="h5 m-0 ml-1">HỆ THỐNG VẬT TƯ - ĐẠI HỌC SƯ PHẠM KỸ THUẬT ĐÀ NẴNG</h2>
      </div>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">Thông báo</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Xem tất cả</a>
      </div>
    </li>
    <li class="nav-item dropdown user user-menu d-flex align-items-center">
      <a href="#" class="nav-link" data-toggle="dropdown">
        <img src="{{ asset('img/user.png') }}" class="user-image" alt="User Image">
        <span class="hidden-xs"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
          {{ auth()->user()->name }}
        </span>
        
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-user mr-2"></i>Trang cá nhân
        </a>
        <a href="#" class="dropdown-item">
          <i class="fas fa-question mr-2"></i>Hướng dẫn
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
        </a>
      </div>
    </li>
  </ul>
</nav>