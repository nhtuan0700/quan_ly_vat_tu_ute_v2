@extends('master')
@section('title')
Quản lý văn phòng phẩm
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
                  <form method="POST" action="#">
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
                      <div class="form-group col-md-3">
                        <label>Đợt đăng ký:</label>
                        <p>{{ $phieu->id_dotdk }}</p>
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
                      <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#modal">Chi tiết tổng hợp</button>
                      <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalLabel">
                                Danh sách chi tiết đăng ký của đơn vị {{ auth()->user()->donvi->name }}
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
                                  <th>Tên văn phòng phẩm</th>
                                  <th>Đơn vị tính</th>
                                  <th class="text-center">Số lượng yêu cầu</th>
                                </tr>
                                <tbody>
                                  @foreach ($list_dangky_donvi as $item)
                                    <tr>
                                      <th>{{ $item->id_user }}</th>
                                      <td>{{ $item->name_user }}</td>
                                      <td>{{ $item->name_vpp }}</td>
                                      <td>{{ $item->dvt }}</td>
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
                        <tr>
                          <th>STT</th>
                          <th>Tên văn phòng phẩm</th>
                          <th>Đơn vị tính</th>
                          <th class="text-center">Số lượng yêu cầu</th>
                          <th>Giá</th>
                        </tr>
                        <tbody>
                          @php
                            $i = 1;
                          @endphp
                          @foreach ($phieu->details() as $item)
                            <tr>
                              <th>{{ $i++ }}</th>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->dvt }}</td>
                              <td class="text-center">{{ $item->qty }}</td>
                              <td>{{ $item->cost }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <a href="{{ route('phieumua.index') }}" class="btn btn-warning mr-2">Trở về</a>
                  </form>
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