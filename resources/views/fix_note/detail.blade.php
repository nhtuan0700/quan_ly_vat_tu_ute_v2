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
                      <p>{{ $note->id }}</p>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Ngày lập phiếu:</label>
                      <p>{{ $note->created_at }}</p>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Trạng thái phiếu:</label>
                      <p>{!! $note->statusHTML !!}</p>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>Người lập phiếu:</label>
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
                      <p>{{ optional($note->handler)->name }}</p>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Ngày xử lý:</label>
                      <p>{{ $note->processed_at }}</p>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Ghi chú:</label>
                      <p>
                        {{ $note->description }}
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
                        @foreach ($note->detail_fix as $item)
                          <tr>
                            <th>{{ $item->id_equipment }}</th>
                            <td>{{ $item->equipment->name }}</td>
                            <td>{{ $item->equipment->room }}</td>
                            <td>
                              {{ $item->equipment->statusText }}
                            </td>
                            <td>{{ $item->reason }}</td>
                            <td>{{ $item->cost }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                  <a href="{{ route('fix_note.index') }}" class="btn btn-warning mr-2">Trở về</a>
                  @can('update_fix', $note)
                    <a href="{{ route('fix_note.edit', ['id' => $note->id]) }}" class="btn btn-info mr-2">Sửa</a>
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