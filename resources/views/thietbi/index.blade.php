@extends('master')
@section('title')
Quản lý thiết bị
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
              <a href="{{ route('thietbi.create') }}" class="btn btn-success">Tạo mới</a>
            </div>
          </div>

          <div class="card-body pb-0">
            {{-- Search --}}
            <form method="GET" action="{{ route('thietbi.search') }}">
              <div class="form-row">
                {{-- Name --}}
                <div class="form-group col-md-2">
                  <label for="name">ID:</label>
                  <input type="text" class="form-control" id="id" name="id"
                    value="{{ request()->id ?? '' }}" autocomplete="off">
                </div>
                {{-- <div class="form-group col-md-2">
                  <label for="name">Tên:</label>
                  <input type="text" class="form-control" id="name" name="name"
                    value="{{ request()->name ?? '' }}" autocomplete="off">
                </div> --}}
                <button type="submit" class="btn btn-primary align-self-end mb-3 ml-2">Tìm kiếm</button>
              </div>
            </form>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Tên</th>
                  <th scope="col">Phòng</th>
                  <th scope="col" width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list_thietbi as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->phong }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <a href="{{ route('thietbi.edit', ['id' => $item->id]) }}"
                        class="btn btn-info flex-grow-1">Sửa</a>
                      <div class="m-1"></div>
                      <form class="d-none" action="{{ route('thietbi.delete', ['id' => $item->id]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                      </form>
                      <button type="button" class="btn btn-danger btn-delete flex-grow-1" 
                        data-name="{{ $item->name }}">
                        Xóa</button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          
            <div class="d-flex mt-4 justify-content-between">
              <div class="dataTables_info">Kết quả: {{ $list_thietbi->total() }}</div>
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                {{ $list_thietbi->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@section('tag_head')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    $('.select2').select2()
  })

  $('.btn-delete').click(function(e) {
    e.preventDefault();
    let name = $(this).data('name')
    var isConfirm = confirm(`Bạn có chắc muốn xóa ${name}`)
    if (isConfirm) {
      $(this).siblings('form').submit()
    }
  })
</script>
@endsection