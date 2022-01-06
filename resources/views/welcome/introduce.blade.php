@extends('welcome.layout')

@section('body')
<div class="body-content d-flex flex-column align-items-center">
  <div class="item d-flex flex-column align-items-center">
    <h4 class="text-bold">Giới thiệu</h4>
    <div class="content">
      <h5 class="text-primary text-bold">1. Cơ cấu tổ chức</h5>
      <div class="text-center">
        <img src="{{ asset('img/co_cau_to_chuc.png') }}" alt="" class="w-75">
      </div>
      
      <h5 class="text-primary text-bold">2. Quy trình</h5>
      <div class="text-center">
        <img src="{{ asset('img/quy_trinh.png') }}" alt="" class="w-75">
      </div>
    </div>
  </div>
</div>
@endsection