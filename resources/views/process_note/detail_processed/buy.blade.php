@extends('master')
@section('title')
  Xét duyệt phiếu đề nghị
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
                <h5>Danh sách tổng hợp đăng ký văn phòng phẩm của đơn vị
                </h5>
                <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#modal">Chi tiết tổng
                  hợp</button>
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">
                          Danh sách chi tiết đăng ký của đơn vị {{ $note->department->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <table class="table">
                          <tr>
                            <th>Mã cán bộ</th>
                            <th>Tên cán bộ</th>
                            <th>Đơn vị</th>
                            <th>Tên văn phòng phẩm</th>
                            <th>Đơn vị tính</th>
                            <th class="text-center">Số lượng yêu cầu</th>
                          </tr>
                          <tbody>
                            @foreach ($depm_registrations as $item)
                              <tr>
                                <th>{{ $item->id_user }}</th>
                                <td>{{ $item->name_user }}</td>
                                <td>{{ $item->name_department }}</td>
                                <td>{{ $item->name_stationery }}</td>
                                <td>{{ $item->unit }}</td>
                                <td class="text-center">{{ $item->qty }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên văn phòng phẩm</th>
                      <th>Đơn vị tính</th>
                      <th class="text-center">Số lượng yêu cầu</th>
                      <th width="20%">Giá</th>
                      @can('view_handover', $note)
                        @php($can_view_handover = true)
                      @else
                        @php($can_view_handover = false)
                      @endcan
                      @if ($can_view_handover)
                        <th class="text-center">Số lượng đã bàn giao</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @php($i = 1)
                    @foreach ($note->detail_buy as $item)
                      <tr>
                        <th>{{ $i++ }}</th>
                        <td>{{ $item->stationery->name }}</td>
                        <td>{{ $item->stationery->unit }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td>
                          {{ format_currency($item->cost) }}
                        </td>
                        @if ($can_view_handover)
                          <td class="text-center">{{ $item->qty_handovered }}</td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
              <a href="{{ route('process_note.index') }}" class="btn btn-warning mr-2">Trở về</a>
              @can('view_handover', $note)
                <button type="button" class="btn btn-default mr-2" data-toggle="modal" data-target="#modalListHandover">
                  Lịch sử bàn giao</button>
                @include('handover_note.components.modal_list', ['handover_notes' => $note->handover_notes])
              @endcan
              @can('create_handover', $note)
                <a href="{{ route('handover_note.create', ['id_request_note' => $note->id]) }}"
                  class="btn btn-success">Tạo phiếu bàn giao</a>
              @endcan
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script src="{{ asset('js/currency.js') }}"></script>
@endsection
