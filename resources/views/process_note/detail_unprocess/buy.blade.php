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
              <form method="POST" action="{{ route('process_note.confirm', ['id' => $note->id]) }}">
                @csrf
                @include('buy_note.components.info', ['note' => $note])
                <hr>
                <div>
                  <button type="button" class="btn btn-light mb-1" data-toggle="modal" data-target="#modal">
                    Danh sách tổng hợp chi tiết đăng ký văn phòng phẩm của đơn vị
                  </button>
                  @include('buy_note.components.modal_stationery', ['department_name' => $note->department->name])
                  <table class="table">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên văn phòng phẩm</th>
                        <th>Đơn vị tính</th>
                        <th class="text-center">Số lượng yêu cầu</th>
                        <th width="20%">Giá</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($note->detail_buy as $item)
                        <tr>
                          <th>{{ $i++ }}</th>
                          <td>{{ $item->stationery->name }}</td>
                          <td>{{ $item->stationery->unit }}</td>
                          <td class="text-center">{{ $item->qty }}</td>
                          <td>
                            <div class="input-group pr-3">
                              <input type="text" class="form-control d-inline w-75"
                                name="stationeries[{{ $item->id_stationery }}][cost]" autocomplete="off"
                                data-type="currency">
                              <div class="input-group-prepend">
                                <span class="input-group-text">đ</span>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
                <a href="{{ route('process_note.index') }}" class="btn btn-default mr-1">Quay lại</a>
                <button class="btn btn-primary">Duyệt phiếu</button>
              </form>
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
