@extends('master')
@section('title')
Lịch sử đăng ký văn phòng phẩm
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
                    <a href="{{ route('history.index', ['id_dotdk' => $item->id]) }}" class="list-group-item list-group-item-action">
                      Đợt {{ $item->id }} ({{ $item->start_at }} - {{ $item->end_at }})
                      @if ($item->getRawOriginal('start_at') > now())
                        <span class="text-success">Chưa diễn ra</span>
                      @else
                        @if (\Carbon\Carbon::now()->between($item->getRawOriginal('start_at'), $item->getRawOriginal('end_at')))
                          <span class="text-warning">Đang diễn ra</span>  
                        @else
                          <span class="text-danger">Đã diễn ra</span>
                        @endif
                      @endif
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