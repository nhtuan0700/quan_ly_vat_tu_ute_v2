@extends('master')
@section('title')
  Quản lý phiếu bàn giao
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
                <a href="{{ route('process_note.index') }}?status=2" class="btn btn-success">Tạo mới</a>
              </div>
            </div>

            <div class="card-body pb-0">
              {{-- Search --}}
              <form method="GET" action="#">
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label for="id">Mã phiếu:</label>
                    <input type="text" class="form-control" id="id" name="id" 1 value="{{ request()->id ?? '' }}"
                      autocomplete="off">
                  </div>
                  <button type="submit" class="btn btn-primary align-self-end mb-3 ml-2">Tìm kiếm</button>
                </div>
              </form>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã phiếu bàn giao</th>
                    <th scope="col">Mã phiếu đề nghị</th>
                    <th scope="col">Ngày tạo phiếu bàn giao</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" width="10%">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($notes as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->id_request_note }}</td>
                      <td>{{ $item->created_at }}</td>
                      <td>
                        {{ $item->statusText }}
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('handover_note.detail', ['id' => $item->id]) }}"
                            class="btn btn-info mr-2">Xem</a>

                          @can('delete', $item)
                            <form class="d-none" action="{{ route('handover_note.delete', ['id' => $item->id]) }}"
                              method="post">
                              @csrf
                              @method('delete')
                            </form>
                            <button type="button" class="btn btn-danger btn-delete" data-name="{{ $item->name }}">
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
  <script>
    $(function() {
      $('.select2').select2()
    })

    $('.btn-delete').click(function(e) {
      e.preventDefault();
      var isConfirm = confirm(`Bạn có chắc muốn xóa`)
      if (isConfirm) {
        $(this).siblings('form').submit()
      }
    })
  </script>
@endsection
