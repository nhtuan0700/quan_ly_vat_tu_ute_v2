<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Hệ thống quản lý vật tư - UTE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  @yield('tag_head')
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">
    {{-- Header --}}
    @include('components.header')

    {{-- Sidebar --}}
    @include('components.sidebar')

    <div class="content-wrapper">
      <!-- Main content -->
      <div class="content p-3">
        <div class="container-fluid card">
          <div class="card-header">
            <div>
              <p class="card-title mr-3">
                @yield('title')
              </p>
            </div>
          </div>
          <div class="card-body">
            @yield('content')
          </div>
        </div>
      </div>
    </div>

    {{-- Footer --}}
    @include('components.footer')

  </div>
  <div class="box-spinner d-none">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  {{-- Active Link --}}
  <script src="{{ asset('js/active-link.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  
  @php
    if (session('alert-success'))
    {
      echo '<script>toastr.success("'.session('alert-success').'")</script>';
    }
    if (session('alert-fail'))
    {
      echo '<script>toastr.error("'.session('alert-fail').'")</script>';
    }
  @endphp 

  @yield('script')
</body>

</html>