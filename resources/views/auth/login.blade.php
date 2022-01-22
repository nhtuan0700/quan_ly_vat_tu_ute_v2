<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | Đăng nhập</title>
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
  <style>
    .login-page {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      
    }
    .login-box {
      width: 400px
    }
  </style>
</head>

<body class="login-page" style="height: unset;background: url('{{ asset('img/background_login.png') }}')" >
  <div class="login-box">
    {{-- <div class="login-logo">
      <b>HỆ THỐNG VẬT TƯ</b>
      <p>Trường Đại Học Sư Phạm Kỹ Thuật</p>
    </div> --}}
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body pb-0">
        <div class="logo">
          <a href="{{ route('welcome') }}">
            <img src="{{ asset('img/logo2.png') }}" alt="" style="height: 60px">
          </a>
        </div>
      </div>

      <div class="card-body login-card-body">
        <p class="login-box-msg text-bold">Đăng nhập để tiếp tục</p>

        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="input-group mb-3 form-group">
            <input type="text" class="form-control @error('email') is-invalid @enderror"
              placeholder="Email" name="email" value="{{ old('email') }}" autofocus rules="required|email">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="input-group mb-3 form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror"
              placeholder="Password" name="password" rules="required">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-group form-check d-flex justify-content-between">
            <div>
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Nhớ tài khoản</label>
            </div>
            <p class="mb-1">
              <a href="{{ route('forgot_password.submit_email') }}">Quên mật khẩu?</a>
            </p>
          </div>
          <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>

      </div>
    </div>

  </div>

</body>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/validator.js') }}"></script>
<script>
  var validator = new Validator('form');
</script>
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

</html>
