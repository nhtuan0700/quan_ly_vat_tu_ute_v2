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
                  <form method="POST" action="{{ route('phieusua.update', ['id' => $phieu->id]) }}" id="form-phieu">
                    @csrf
                    @method('put')
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
                        <textarea name="note" class="form-control" rows="2" style="resize:none">{{ $phieu->note }}</textarea>                        
                      </div>
                    </div>
                    <hr>
                    <div>
                      <h5>Danh sách tổng hợp đăng ký văn phòng phẩm của đơn vị 
                      </h5>
                      @include('phieusua.components.modal_search_thietbi')
                      <table class="table" id="table-thietbi">
                        <thead>
                          <tr>
                            <th>Mã thiết bị</th>
                            <th>Tên thiết bị</th>
                            <th>Phòng</th>
                            <th>Lý do sửa</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $i = 1;
                          @endphp
                          @foreach ($phieu->details() as $item)
                            <tr data-id="{{ $item->id }}">
                              <th>{{ $item->id }}</th>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->phong }}</td>
                              <td>
                                
                                <input class="form-control" name="thietbi[{{ $item->id }}]" 
                                  value="{{ $item->reason }}" />
                              </td>
                              <td>
                                <button type="button" class="btn btn-danger btn-remove btn-sm"  
                                  data-id="{{ $item->id }}" onclick="removeItem(this)">
                                  Xóa
                              </button> 
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <a href="{{ route('phieusua.detail', ['id' => $phieu->id]) }}" class="btn btn-warning mr-2">Trở về</a>
                    <button class="btn btn-primary mr-2" form="form-phieu">Cập nhật</button>
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

@section('script')
@stack('js')
@endsection