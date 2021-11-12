@extends('master')
@section('title')
  Trang chủ
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
                <h4>Xin chào</h4>
                <h5 class="text-primary">{{ auth()->user()->name }}</h5>
                <p><b>Vai trò: </b><span>{{ auth()->user()->role->name }}</span></p>
                <p><b>Đơn vị: </b><span>{{ auth()->user()->donvi->name }}</span></p>
          </div>
          <!-- /.col-md-6 -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection