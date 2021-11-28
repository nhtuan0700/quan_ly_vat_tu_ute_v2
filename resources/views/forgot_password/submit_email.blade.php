@extends('forgot_password.layout')
@section('content')
<p class="login-box-msg">Xác nhận email</p>
<p>Vui lòng nhập email của bạn. Bạn sẽ nhận được một email hướng dẫn cài đặt mật khẩu mới</p>
<form action="{{ route('forgot_password.submit_email') }}" method="post">
  @csrf
  <div class="input-group mb-3 ">
    <input type="email" class="form-control" placeholder="Email" name="email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block">NHẬN XÁC THỰC QUA EMAIL</button>
    </div>
  </div>
</form>
@endsection