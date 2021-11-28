@extends('master')
@section('title')
  Quản lý phiếu sửa
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
              <form method="POST" action="{{ route('fix_note.store') }}" id="form-phieu">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="name">Người lập phiếu:</label>
                    <p>{{ auth()->user()->name }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Đơn vị:</label>
                    <p>{{ auth()->user()->department->name }}</p>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Ghi chú:</label>
                    <textarea name="description" class="form-control" rows="2" style="resize:none"></textarea>
                  </div>
                </div>
                <hr>
                <div>
                  <h5>Danh sách thiết bị đề nghị sửa</h5>
                  @include('fix_note.components.modal_search_equipment')
                  <table class="table" id="table-equipment">
                    <thead>
                      <tr>
                        <th>Mã thiết bị</th>
                        <th>Tên thiết bị</th>
                        <th>Phòng</th>
                        <th>Trạng thái</th>
                        <th>Lý do sửa</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>

                </div>
                <a href="{{ route('fix_note.index') }}" class="btn btn-warning mr-2">Trở về</a>
                <button type="submit" class="btn btn-primary" form="form-phieu">Tạo phiếu</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
