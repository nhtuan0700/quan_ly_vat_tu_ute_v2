<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | Quên mật khẩu</title>
  <link rel="icon" href="{{ asset('iconute.ico') }}" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition login-page" style="height: unset">
  <div class="login-box w-50 mt-5">
    <div class="login-logo">
      <b>HỆ THỐNG VẬT TƯ</b>
      <p>Trường Đại Học Sư Phạm Kỹ Thuật</p>
    </div>
    <!-- /.login-logo -->
    <div class="card w-50 m-auto">
      <div class="card-body login-card-body">
        @yield('content')
        <a href="{{ route('login') }}">Đăng nhập</a>
      </div>
    </div>

  </div>

</body>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@if (session('alert-success'))
  <script>
    toastr.success("{{ session('alert-success') }}")
  </script>
@endif
@if (session('alert-fail'))
  <script>
    toastr.error("{{ session('alert-fail') }}")
  </script>
@endif
@yield('script')
</html>