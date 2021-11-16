@extends('master')
@section('title')
Quản lý phiếu mua đơn vị
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div>
              <p class="card-title mr-3">Tạo mới - Tổng hợp</p>
            </div>
          </div>

          <div class="card-body">
            <p>{{ $message }}</p>
            <a href="{{ route('buy_note.list_period') }}" class="btn btn-warning">Trở về</a>

          </div>

        </div>
      </div>
    </div>

  </div>
</section>
@endsection