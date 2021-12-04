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
                <p class="card-title mr-3">Chi tiết</p>
              </div>
            </div>

            <div class="card-body">
              @include('buy_note.components.info', ['note' => $note])
              <hr>
              <div>
                <button type="button" class="btn btn-light mb-1" data-toggle="modal" data-target="#modal">
                  Danh sách tổng hợp chi tiết đăng ký văn phòng phẩm của đơn vị
                </button>
                @include('buy_note.components.modal_stationery', ['department_name' => $note->department->name])
                <table class="table">
                  <tr>
                    <th>STT</th>
                    <th>Tên văn phòng phẩm</th>
                    <th>Đơn vị tính</th>
                    <th class="text-center">Số lượng yêu cầu</th>
                    <th>Giá</th>
                    @can('view_handover', $note)
                      @php($can_view_handover = true)
                    @else
                      @php($can_view_handover = false)
                    @endcan
                    @if ($can_view_handover)
                      <th class="text-center">Số lượng đã bàn giao</th>
                    @endif
                  </tr>
                  <tbody>
                    @php($i = 1)
                    @foreach ($note->detail_buy as $item)
                      <tr>
                        <th>{{ $i++ }}</th>
                        <td>{{ $item->stationery->name }}</td>
                        <td>{{ $item->stationery->unit }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td>{{ format_currency($item->cost) }}</td>
                        @if ($can_view_handover)
                          <td class="text-center">{{ $item->qty_handovered }}</td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
              <a href="{{ route('buy_note.index') }}" class="btn btn-default mr-1">Quay lại</a>
              @can('view_handover', $note)
                <button type="button" class="btn btn-default mr-1" data-toggle="modal" data-target="#modalListHandover">
                  Lịch sử bàn giao</button>
                @include('handover_note.components.modal_list', ['handover_notes' => $note->handover_notes])
              @endcan
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
