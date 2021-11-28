@extends('master')
@section('title')
Quản lý người dùng
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
              <a href="{{ route('user.create') }}" class="btn btn-success">Tạo mới</a>
              <a href="{{ route('user.export') }}" class="btn btn-default ml-2">Export Excel</a>
              @include('user.components.import_excel')
            </div>
          </div>

          <div class="card-body pb-0">
            {{-- Search --}}
            <form method="GET" action="{{ route('user.search') }}">
              <div class="form-row">
                {{-- ID --}}
                <div class="form-group col-md-2">
                  <label for="id">Mã:</label>
                  <input type="text" class="form-control" id="id" name="id"
                    value="{{ request()->id ?? '' }}" autocomplete="off">
                </div>
                {{-- Name --}}
                <div class="form-group col-md-2">
                  <label for="name">Họ Tên:</label>
                  <input type="text" class="form-control" id="name" name="name"
                    value="{{ request()->name ?? '' }}" autocomplete="off">
                </div>
                {{-- Email --}}
                <div class="form-group col-md-2">
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" id="email" name="email"
                    value="{{ request()->email ?? '' }}" autocomplete="off">
                </div>
                {{-- Đơn vị --}}
                <div class="form-group col-md-3">
                  <label for="department">Đơn vị:</label>
                  <select id="department" class="form-control select2" name="id_department">
                    <option value="">Tất cả</option>
                    @foreach ($departments as $item)
                      @if ($item->id == request()->id_department)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                      @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                {{-- Role --}}
                <div class="form-group col-md-2">
                  <label for="role">Vai trò:</label>
                  <select id="role" class="form-control" name="id_role">
                    <option value="">Tất cả</option>
                    @foreach ($roles as $role)
                      @if ($role->id == request()->id_role)
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                      @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary align-self-end mb-3 ml-2">Tìm kiếm</button>
              </div>
            </form>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">Mã</th>
                  <th scope="col">Họ Tên</th>
                  <th scope="col">Email</th>
                  <th scope="col">Số điện thoại</th>
                  <th scope="col">Đơn vị</th>
                  <th scope="col">Vai trò</th>
                  <th scope="col" width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->tel }}</td>
                  <td>{{ $item->department->name }}</td>
                  <td>{{ $item->role->name }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <a href="{{ route('user.edit', ['id'=>$item->id]) }}"
                        class="btn btn-info flex-grow-1">Sửa</a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          
            <div class="d-flex mt-4 justify-content-between">
              <div class="dataTables_info">Kết quả: {{ $users->total() }}</div>
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                {{ $users->links() }}
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
</script>
@endsection