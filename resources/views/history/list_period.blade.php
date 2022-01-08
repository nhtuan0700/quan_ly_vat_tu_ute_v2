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
                    @foreach ($periods as $item)
                      <a href="{{ route('history.index', ['id_period' => $item->id]) }}"
                        class="list-group-item list-group-item-action">
                        Đợt {{ $item->id }} ({{ $item->start_time }} - {{ $item->end_time }})
                        {!! $item->statusHTML !!}
                        @if ($item->myRegistrations->isEmpty())
                          <span class="text-danger">- Không đăng ký</span>
                        @else
                          <span class="text-success">- Đã đăng ký</span>
                          <span> - 
                            {{ $item->checkHandoverEnoughUser() ? 'Bàn giao đủ' : 'Bàn giao chưa đủ' }}
                          </span>
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
