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
              <form method="POST" action="{{ route('fix_note.update', ['id' => $note->id]) }}" id="form-note">
                @csrf
                @method('put')
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Mã phiếu:</label>
                    <p>{{ $note->id }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Ngày tạo phiếu:</label>
                    <p>{{ $note->created_at }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Trạng thái phiếu:</label>
                    <p>{!! $note->statusHTML !!}</p>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Người đề nghị:</label>
                    <p>{{ $note->creator->name }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Đơn vị:</label>
                    <p>{{ $note->department->name }}</p>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Cán bộ duyệt:</label>
                    <p>{{ optional($note->handdler)->name }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Ngày xử lý:</label>
                    <p>{{ $note->processed_at }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Loại phiếu:</label>
                    <p>{{ $note->category }}</p>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Ghi chú:</label>
                    <textarea name="description" class="form-control" rows="2"
                      style="resize:none">{{ $note->description }}</textarea>
                  </div>
                </div>
                <hr>
                <div>
                  <div class="mb-2">
                    <h5 class="d-inline mr-1">Danh sách thiết bị đề nghị sửa</h5>
                    <button type="button" class="btn btn-sm btn-secondary mb-1" data-toggle="modal"
                      data-target="#modal">Chọn thiết bị</button>
                  </div>
                  <table class="table" id="table-equipment">
                    <thead>
                      <tr>
                        <th>Mã thiết bị</th>
                        <th>Tên thiết bị</th>
                        <th>Phòng</th>
                        <th>Lý do sửa</th>
                        <th>Tình trạng</th>
                        <th class="fit"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($note->detail_fix as $item)
                        <tr data-id="{{ $item->id_equipment }}">
                          <th>{{ $item->id_equipment }}</th>
                          <td>{{ $item->equipment->name }}</td>
                          <td>{{ $item->equipment->room }}</td>
                          <td>
                            {{ $item->equipment->statusText }}
                          </td>
                          <td>
                            <div class="form-group">
                              <input class="form-control" name="equipments[{{ $item->id_equipment }}]"
                                value="{{ $item->reason }}" rules="required"/>
                            </div>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger btn-remove" data-id="{{ $item->id }}"
                              onclick="removeItem(this)">
                              Xóa
                            </button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
                <a class="btn btn-default mr-1" href="{{ route('fix_note.detail', ['id' => $note->id]) }}">
                  Quay lại
                </a>
                <button class="btn btn-primary">Cập nhật</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  @include('fix_note.components.modal_search_equipment')

@endsection
