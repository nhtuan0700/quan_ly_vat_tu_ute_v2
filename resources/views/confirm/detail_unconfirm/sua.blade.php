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
            <form action="{{ route('confirm.confirm', ['id' => $phieu->id]) }}" method="post">
              @csrf
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
                  <p>{{ optional($phieu->confirmer)->name }}</p>
                </div>
                <div class="form-group col-md-3">
                  <label>Ngày duyệt:</label>
                  <p>{{ $phieu->confirmed_at }}</p>
                </div>
                <div class="form-group col-md-3">
                  <label>Loại phiếu:</label>
                  <p>{{ $phieu->category }}</p>
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
                <h5>Danh sách thiết bị đề nghị sửa</h5>
                <table class="table">
                  <tr>
                    <th>Mã thiết bị</th>
                    <th>Tên thiết bị</th>
                    <th>Phòng</th>
                    <th>Tình trạng</th>
                    <th>Lý do sửa</th>
                    <th>Chi phí sửa</th>
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
                        <td>
                          @include('thietbi.components.status')
                        </td>
                        <td>{{ $item->reason }}</td>
                        <td>{{ $item->cost }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
              <a href="{{ route('confirm.index') }}" class="btn btn-warning mr-2">Trở về</a>
              <button type="submit" class="btn btn-primary">Duyệt phiếu</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection