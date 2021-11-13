@extends('master')
@section('title')
Quản lý phiếu sửa
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
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
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>Mã phiếu:</label>
                      <p>{{ $phieu->id }}</p>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Ngày lập phiếu:</label>
                      <p>{{ $phieu->created_at }}</p>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Trạng thái phiếu:</label>
                      <p>{!! $phieu->statusHTML !!}</p>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>Người lập phiếu:</label>
                      <p>{{ $phieu->creator->name }}</p>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Đơn vị:</label>
                      <p>{{ $phieu->creator->donvi->name }}</p>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>Cán bộ duyệt:</label>
                      <p>{{ optional($phieu->csvc)->name }}</p>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Ngày duyệt:</label>
                      <p>{{ $phieu->confirmed_at }}</p>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="name">Ghi chú:</label>
                      <p>
                        {{ $phieu->note }}
                      </p>
                    </div>
                  </div>
                  <hr>
                  <div>
                    <h5>Danh sách tổng hợp đăng ký văn phòng phẩm của đơn vị 
                    </h5>
                    <table class="table">
                      <tr>
                        <th>Mã thiết bị</th>
                        <th>Tên thiết bị</th>
                        <th>Phòng</th>
                        <th>Lý do sửa</th>
                        <th>Chi phí sửa</th>
                        <th>Tình trạng sửa</th>
                      </tr>
                      <tbody>
                        @php
                          $i = 1;
                        @endphp
                        @foreach ($phieu->details() as $item)
                          <tr>
                            <th>{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phong }}</td>
                            <td>{{ $item->reason }}</td>
                            <td>{{ $item->cost }}</td>
                            <td>{{ $item->status }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                  <a href="{{ route('phieusua.index') }}" class="btn btn-warning mr-2">Trở về</a>
                  @can('update_sua', $phieu)
                    <a href="{{ route('phieusua.edit', ['id' => $phieu->id]) }}" class="btn btn-info mr-2">Sửa</a>
                  @endcan
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