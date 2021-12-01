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
              <p class="card-title mr-3">Chi tiết đăng ký - Đợt {{ $id_period }}</p>
            </div>
          </div>

          <div class="card-body">
            <div>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tên văn phòng phẩm</th>
                    <th>Đơn vị tính</th>
                    <th class="text-center">Số lượng yêu cầu</th>
                    <th class="text-center">Tổng hợp trong phiếu</th>
                    <th>Ngày bàn giao</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i = 1
                  @endphp
                  @foreach ($registrations as $item)
                    <tr>
                      <th>{{ $i++ }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->unit }}</td>
                      <td class="text-center">{{ $item->qty }}</td>
                      <td class="text-center">
                        @if (!!$item->id_note)
                          <span class="text-success"><i class="fas fa-check"></i></span>
                        @else
                          <span class="text-danger"><i class="fas fa-times"></i></span>
                        @endif
                      </td>
                      <td>{{ format_datetime($item->received_at) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-warning">Trở về</a>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>
@endsection