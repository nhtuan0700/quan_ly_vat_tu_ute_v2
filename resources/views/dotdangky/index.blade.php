@extends('master')
@section('title')
Quản lý đợt đăng ký
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
              <a href="{{ route('dotdangky.create') }}" class="btn btn-success">Tạo mới</a>
            </div>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Thời gian tạo</th>
                  <th scope="col">Thời gian kết thúc</th>
                  <th scope="col">Thời gian kết thúc</th>
                  <th scope="col">Trạng thái</th>
                  <th scope="col" width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list_dotdangky as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->created_at }}</td>
                  <td>{{ $item->start_at }}</td>
                  <td>{{ $item->end_at }}</td>
                  <td>{!! $item->statusHTML !!}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <a href="{{ route('dotdangky.edit', ['id' => $item->id]) }}"
                        class="btn btn-info">Sửa</a>
                      <div class="m-1"></div>
                      @if ($item->canDelete())
                        <form class="d-none" action="{{ route('dotdangky.delete', ['id' => $item->id]) }}"
                          method="post">
                          @csrf
                          @method('delete')
                        </form>
                        <button type="button" class="btn btn-danger btn-delete" 
                          data-name="{{ $item->name }}">
                          Xóa</button>
                      @endif
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          
            <div class="d-flex mt-4 justify-content-between">
              <div class="dataTables_info">Kết quả: {{ $list_dotdangky->total() }}</div>
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                {{ $list_dotdangky->links() }}
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