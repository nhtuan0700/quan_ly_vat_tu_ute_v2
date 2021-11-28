@extends('forgot_password.layout')
@section('content')
  <p class="login-box-msg">Đặt lại mật khẩu</p>
  <form action="{{ route('forgot_password.reset_password') }}" method="post">
    @csrf
    <input type="hidden" name="email" value="{{ session()->get('email') }}">
    <input type="hidden" name="code" value="{{ session()->get('code') }}">
    <div class="input-group mb-3">
      <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu mới"
        name="password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
      @error('password')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="input-group mb-3">
      <input type="password" class="form-control" placeholder="Mật khẩu mới" name="password_confirm">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">Lưu</button>
      </div>
    </div>
  </form>
@endsection
