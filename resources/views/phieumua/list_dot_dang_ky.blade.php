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
                  @foreach ($list_dotdangky as $item)
                    <a href="{{ route('phieumua.create', ['id_dotdk' => $item->id]) }}" class="list-group-item list-group-item-action">
                      Đợt {{ $item->id }} ({{ $item->start_at }} - {{ $item->end_at }})
                        @if (!!$item->getPhieuMuaDonVi())
                          <span class="text-success">Đã tạo phiếu - Xem</span>
                        @else
                          @if (now()->between($item->getRawOriginal('start_at'), $item->getRawOriginal('end_at')))
                            <span class="text-warning">Đang diễn ra</span>  
                          @else
                            <span class="text-danger">Chưa tạo phiếu</span>
                          @endif
                        @endif
                      </span>
                    </a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>
@endsection