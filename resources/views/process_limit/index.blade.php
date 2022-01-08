@extends('master')
@section('title')
  Xử lý yêu cầu cập nhật hạn mức
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Các yêu cầu cập nhật hạn mức
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã người cập nhật</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" class="fit">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($logs as $item)
                    <tr>
                      <td>{{ $item->id_updater }}</td>
                      <td>{{ $item->updater->name }}</td>
                      <td>{{ $item->created_at }}</td>
                      <td>{!! $item->statusHTML !!}</td>
                      <td>
                        <a href="{{ route('process_limit.detail', ['id' => $item->id]) }}" class="btn btn-primary">Xem</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $logs->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $logs->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
