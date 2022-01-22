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
              Chi tiết
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                  <label>Mã người cập nhật:</label>
                  <p>{{ $log->id_updater }}</p>
                </div>
                <div class="col-md-3">
                  <label>Tên người cập nhật:</label>
                  <p>{{ $log->updater->name }}</p>
                </div>
                @if (!is_null($log->is_confirm))
                  <div>
                    <label>Trạng thái:</label>
                    <p>{!! $log->statusHTML !!}</p>
                  </div>
                @endif
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <label>Mã người được cập nhật:</label>
                  <p>{{ $user->id }}</p>
                </div>
                <div class="col-md-3">
                  <label>Tên người được cập nhật:</label>
                  <p>{{ $user->name }}</p>
                </div>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Tên văn phòng phẩm</th>
                    <th scope="col">Đơn vị tính</th>
                    <th scope="col">Hạn mức tối đa hiện tại</th>
                    <th scope="col">Hạn mức cập nhật</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($stationeries as $item)
                    <tr>
                      <td>{{ $item['name'] }}</td>
                      <td>{{ $item['unit'] }}</td>
                      <td>{{ $item['qty_max'] }}</td>
                      <td>{{ $item['qty_max_updating'] }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <hr>
              <p class="text-bold">
                Minh chứng
              </p>
              <div>
                <div class="zoom-image">
                  @foreach ($log->files as $item)
                    <img src="{{ $item }}" class="cursor-pointer" alt="" width="300px"/>
                  @endforeach
                </div>
              </div>

              <div class="mt-2 d-flex">
                @can('process', $log)
                  <form action="{{ route('process_limit.confirm', ['id' => $log->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-primary mr-1">Đồng ý</button>
                  </form>
                  <form action="{{ route('process_limit.reject', ['id' => $log->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-danger">Từ chối</button>
                  </form>
                @else
                  <div class="mt-2">
                    <p><b>Người xử lý:</b> {{ $log->confirmer->id }} - {{ $log->confirmer->name }}</p>
                  </div>
                @endcan
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <div class="modal fade" id="modalZoomImage" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Minh chứng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="" alt="" class="img w-100">
        </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/zoom-image.js') }}"></script>
  <script>
    $(function () {
      const zoomImage = new ZoomImage('.zoom-image', '#modalZoomImage')
    })
  </script>
@endsection
