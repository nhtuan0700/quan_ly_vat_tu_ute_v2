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
              <div class="d-flex  align-items-center">
                <span class="card-title mr-3">Danh sách</span>
                <a href="{{ route('fix_note.create') }}" class="btn btn-success">Tạo mới</a>
              </div>
            </div>

            <div class="card-body pb-0">
              {{-- Search --}}
              <form method="GET" action="{{ route('fix_note.search') }}">
                <div class="form-row form-row-0">
                  <div class="form-group col-md-2">
                    <label for="name">Mã phiếu:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ request()->id ?? '' }}"
                      autocomplete="off">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="status">Trạng thái phiếu:</label>
                    <select class="form-control" name="status" id="">
                      <option value>Tất cả</option>
                      <option value="1" @if (request()->status == 1) selected @endif>Chờ xử lý</option>
                      <option value="2" @if (request()->status == 2) selected @endif>Chờ bàn giao</option>
                      <option value="3" @if (request()->status == 3) selected @endif>Đã hoàn thành</option>
                      <option value="3" @if (request()->status == 4) selected @endif>Bị từ chối</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary align-self-end">Tìm kiếm</button>
                </div>
              </form>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã phiếu</th>
                    <th scope="col">Ngày tạo phiếu</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" class="fit">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($notes as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->created_at }}</td>
                      <td>{!! $item->statusHTML !!}</td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('fix_note.detail', ['id' => $item->id]) }}" class="btn btn-info">Xem</a>
                          <div class="m-1"></div>
                          @can('delete_fix', $item)
                            <form class="d-none" action="{{ route('fix_note.delete', ['id' => $item->id]) }}"
                              method="post">
                              @csrf
                              @method('delete')
                            </form>
                            <button type="button" class="btn btn-danger btn-delete">
                              Xóa</button>
                          @endcan
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $notes->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $notes->links() }}
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
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $(function() {
      $('.btn-delete').click(function(e) {
        e.preventDefault();
        var isConfirm = confirm(`Bạn có chắc muốn xóa`)
        if (isConfirm) {
          $(this).siblings('form').submit()
        }
      })
    })
  </script>
@endsection
