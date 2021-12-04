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
              @include('fix_note.components.info', ['note' => $note])
              <hr>
              <div>
                <h5 class="mb-2">Danh sách thiết bị đề nghị sửa</h5>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Mã thiết bị</th>
                      <th>Tên thiết bị</th>
                      <th>Phòng</th>
                      <th>Lý do sửa</th>
                      <th>Tình trạng sửa</th>
                      <th>Chi phí sửa</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($note->detail_fix as $item)
                      <tr>
                        <th>{{ $item->id_equipment }}</th>
                        <td>{{ $item->equipment->name }}</td>
                        <td>{{ $item->equipment->room }}</td>
                        <td>{{ $item->reason }}</td>
                        <td>
                          {{ $item->statusText }}
                        </td>
                        <td>{{ $item->cost }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
              <div class="d-flex">
                <a class="btn btn-default mr-1" href="{{ route('process_note.index') }}">Quay lại</a>
                @can('reject', $note)
                  <form action="{{ route('process_note.reject', ['id' => $note->id]) }}" method="post"
                    class="mr-1" onsubmit="return confirm('Bạn có chắc muốn từ chối phiếu này?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">Từ chối</button>
                  </form>
                @endcan
                @can('confirm', $note)
                  <form action="{{ route('process_note.confirm', ['id' => $note->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Duyệt phiếu</button>
                  </form>
                @endcan
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
