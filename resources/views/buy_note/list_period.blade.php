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
              <p class="card-title mr-3">Danh sách các đợt đăng ký</p>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="list-group">
                  @foreach ($periods as $item)
                    <a href="{{ route('buy_note.create', ['id_period' => $item->id]) }}" class="list-group-item list-group-item-action">
                      Đợt {{ $item->id }} ({{ $item->start_time }} - {{ $item->end_time }})
                        @can ('view_buy_note', $item)
                          <span class="text-success">Đã tạo phiếu - Xem</span>
                        @else
                          @if (now()->between($item->getRawOriginal('start_time'), $item->getRawOriginal('end_time')))
                            <span class="text-warning">Đang diễn ra</span>  
                          @else
                            <span class="text-danger">Chưa tạo phiếu</span>
                          @endif
                        @endcan
                      </span>
                    </a>
                  @endforeach
                </div>
              </div>
            </div>
            <a href="{{ route('buy_note.index') }}" class="btn btn-default mt-2">Quay lại</a>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>
@endsection