<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ config('app.name') }}</title>
  <link rel="icon" href="{{ asset('iconute.ico') }}" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  @yield('tag_head')
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
  <style>
  </style>
</head>

<body>
  <div class="container-fluid p-0">
    <div class="header">
      <div class="container">
        <div class="logo">
          <a href="{{ route('welcome') }}">
            <img src="{{ asset('img/logo2.png') }}" alt="">
          </a>
        </div>
        <a href="{{ route('login') }}" class="btn btn-outline-primary">
          @if (auth()->check())
            Đến hệ thống  
          @else
            Đăng nhập
          @endif
        </a>
      </div>
    </div>
    @include('welcome.banner')
    <div class="body container">
      @yield('body')
    </div>

    <div class="footer">
      <div class="container">
        <span>Copyright 2022 Website University of Technology and Education - The University of Danang. All Rights Reserved.</span>
        <br>
        <span>Địa chỉ: số 48 Cao Thắng, TP. Đà Nẵng - Điện thoại: (0236) 3822571 - Email: dhspktdn@ute.udn.vn</span>
      </div>
    </div>
  </div>

  
  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>