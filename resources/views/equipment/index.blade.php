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
                <a href="{{ route('equipment.create') }}" class="btn btn-success">Tạo mới</a>
              </div>
            </div>

            <div class="card-body pb-0">
              {{-- Search --}}
              <form method="GET" action="{{ route('equipment.search') }}">
                <div class="form-row form-row-0">
                  {{-- Name --}}
                  <div class="form-group col-md-2">
                    <label for="name">Mã:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ request()->id ?? '' }}"
                      autocomplete="off">
                  </div>
                  <button type="submit" class="btn btn-primary align-self-end">Tìm kiếm</button>
                </div>
              </form>
            </div>

            <div class="card-body">
              <div class="dt-buttons btn-group flex-wrap mb-2">
                <a href="{{ route('equipment.export') }}" class="btn btn-secondary mr-1">
                  <span>Export Excel</span>
                </a>
                <a class="btn btn-secondary" data-toggle="modal" data-target="#modalImport">
                  <span>Import Excel</span>
                </a>
              </div>
              @include('equipment.components.import_excel')
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Phòng</th>
                    <th scope="col">Ngày cấp</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" class="fit">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($equipments as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->room }}</td>
                      <td>{{ $item->date_grant }}</td>
                      <td>{{ $item->statusText }}</td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('equipment.edit', ['id' => $item->id]) }}"
                            class="btn btn-info">Sửa</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $equipments->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $equipments->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
