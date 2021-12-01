@extends('master')
@section('title')
  Trang chủ
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div>
            <h4>Xin chào</h4>
            <h5 class="text-primary">{{ auth()->user()->name }}</h5>
            <p><b>Vai trò: </b><span>{{ auth()->user()->role->name }}</span></p>
            <p><b>Đơn vị: </b><span>{{ auth()->user()->department->name }}</span></p>
          </div>
          <hr>
          <div>
            <h4>Các đợt đăng ký văn phòng phẩm mới</h4>
            <div class="list-group w-50">
              @foreach ($periods as $item)
                <div class="list-group-item list-group-item-action">
                  Đợt {{ $item->id }} ({{ $item->start_time }} - {{ $item->end_time }})
                  {!! $item->statusHTML !!}
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
