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
              <form method="POST" action="{{ route('buy_note.store', ['id_period' => $id_period]) }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="name">Người lập phiếu:</label>
                    <p>{{ auth()->user()->name }}</p>

                  </div>
                  <div class="form-group col-md-3">
                    <label>Đợt đăng ký:</label>
                    <p>{{ $id_period }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Đơn vị:</label>
                    <p>{{ auth()->user()->department->name }}</p>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Ghi chú:</label>
                    <textarea name="description" class="form-control" rows="2" style="resize:none"></textarea>
                  </div>
                </div>
                <hr>
                <div>
                  <button type="button" class="btn btn-light mb-1" data-toggle="modal" data-target="#modal">
                    Danh sách tổng hợp chi tiết đăng ký văn phòng phẩm của đơn vị
                  </button>
                  @include('buy_note.components.modal_stationery', ['department_name' => auth()->user()->department->name])
                  <table class="table">
                    <tr>
                      <th>STT</th>
                      <th>Tên văn phòng phẩm</th>
                      <th>Đơn vị tính</th>
                      <th class="text-center">Số lượng yêu cầu</th>
                    </tr>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($sum_stationeries as $item)
                        <tr>
                          <th>{{ $i++ }}</th>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->unit }}</td>
                          <td class="text-center">{{ $item->qty }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
                <a href="{{ route('buy_note.list_period') }}" class="btn btn-default mr-1">Quay lại</a>
                <button type="submit" class="btn btn-primary">Tạo phiếu</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
