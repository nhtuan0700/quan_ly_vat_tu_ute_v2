@extends('welcome.layout')

@section('body')
<div class="body-content d-flex flex-column align-items-center">
  <div class="item d-flex flex-column align-items-center">
    <h4 class="text-bold">Giới thiệu</h4>
    <a href="{{ route('introduce') }}" class="btn btn-outline-info">Xem</a>
  </div>
  <div class="item d-flex flex-column align-items-center mt-3">
    <h4 class="text-bold">Hướng dẫn</h4>
    <a href="#" class="btn btn-outline-info">Xem</a>
  </div>
</div>

<div class="body-content benefit row">
  <div class="benefit-item col-md-3">
    <div class="icon">
      <i class="fas fa-shield-alt"></i>
    </div>
    <div class="content">
      Hệ thống chính xác, Bảo mật
    </div>
  </div>
  <div class="benefit-item col-md-3">
    <div class="icon">
      <i class="fas fa-bolt"></i>
    </div>
    <div class="content">
      Quy trình sửa chữa, mua sắm nhanh chóng & dễ dàng hơn
    </div>
  </div>
  <div class="benefit-item col-md-3">
    <div class="icon">
      <i class="fab fa-accusoft"></i>
    </div>
    <div class="content">
      Giao diện dễ sử dụng
    </div>
  </div>
</div>
@endsection