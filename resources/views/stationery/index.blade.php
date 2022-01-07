@extends('master')
@section('title')
  Quản lý văn phòng phẩm
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
                <a href="{{ route('stationery.create') }}" class="btn btn-success">Tạo mới</a>
              </div>
            </div>

            <div class="card-body pb-0">
              {{-- Search --}}
              <form method="GET" action="{{ route('stationery.search') }}">
                <div class="form-row form-row-0">
                  {{-- Name --}}
                  <div class="form-group col-md-2">
                    <label for="name">Tên:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ request()->name ?? '' }}"
                      autocomplete="off">
                  </div>
                  {{-- <div class="form-group col-md-2">
                    <label for="category">Danh mục:</label>
                    <select name="id_category" id="category" class="form-control">
                      <option value>Tất cả</option>
                      @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if ($item->id == request()->id_category) selected @endif>
                          {{ $item->name }}
                        </option>
                      @endforeach
                    </select>
                  </div> --}}
                  <button type="submit" class="btn btn-primary align-self-end">Tìm kiếm</button>
                </div>
              </form>
            </div>

            <div class="card-body">
              <div class="dt-buttons btn-group flex-wrap mb-2">
                <a href="{{ route('stationery.export') }}" class="btn btn-secondary mr-1">
                  <span>Export Excel</span>
                </a>
                <a class="btn btn-secondary" data-toggle="modal" data-target="#modalImport">
                  <span>Import Excel</span>
                </a>
              </div>
              @include('stationery.components.import_excel')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Đơn vị tính</th>
                    {{-- <th scope="col">Danh mục</th> --}}
                    <th scope="col" class="fit">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($stationeries as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->unit }}</td>
                      {{-- <td>{{ optional($item->category)->name }}</td> --}}
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('stationery.edit', ['id' => $item->id]) }}" class="btn btn-info">Sửa</a>
                          <div class="m-1"></div>
                          <form class="d-none" action="{{ route('stationery.delete', ['id' => $item->id]) }}"
                            method="post">
                            @csrf
                            @method('delete')
                          </form>
                          <button type="button" class="btn btn-danger btn-delete" data-name="{{ $item->name }}">
                            Xóa</button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $stationeries->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $stationeries->links() }}
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
        let name = $(this).data('name')
        var isConfirm = confirm(`Bạn có chắc muốn xóa ${name}`)
        if (isConfirm) {
          $(this).siblings('form').submit()
        }
      })
    })
  </script>
@endsection
