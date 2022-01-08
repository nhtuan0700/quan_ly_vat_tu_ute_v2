@extends('master')
@section('title')
  Lịch sử đăng ký văn phòng phẩm
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div>
                <p class="card-title mr-3">Chi tiết đăng ký</p>
              </div>
            </div>

            <div class="card-body">
              <form action="{{ route('handover_registration.handover') }}" method="post">
                @csrf
                <input type="hidden" name="id_user" value="{{ request()->id_user }}">
                <input type="hidden" name="id_period" value="{{ request()->id_period }}">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>Mã:</label>
                    <p>{{ $user->id }}</p>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Họ tên:</label>
                    <p>{{ $user->name }}</p>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Đơn vị:</label>
                    <p>{{ $user->department->name }}</p>
                  </div>
                </div>
                <div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Tên văn phòng phẩm</th>
                        <th>Đơn vị tính</th>
                        <th class="text-center">Số lượng yêu cầu</th>
                        <th class="text-center">Tổng hợp trong phiếu</th>
                        <th class="text-center">Bàn giao</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($registrations as $item)
                        <tr>
                          <th>{{ $i++ }}</th>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->unit }}</td>
                          <td class="text-center">{{ $item->qty }}</td>
                          <td class="text-center">
                            @if (!!$item->id_note)
                              <span class="text-success"><i class="fas fa-check"></i></span>
                            @else
                              <span class="text-danger"><i class="fas fa-times"></i></span>
                            @endif
                          </td>
                          <td class="text-center">
                            @if (is_null($item->received_at))
                              <div class="icheck-success d-inline">
                                <input type="checkbox" id="stationery{{ $item->id }}"
                                  name="stationeries[{{ $item->id }}]">
                                <label for="stationery{{ $item->id }}">
                                </label>
                              </div>
                            @else
                              <span class="text-success" data-toggle="tooltip" data-placement="bottom"
                                title="{{ format_datetime($item->received_at) }}">
                                <i class="fas fa-check"></i></span>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <a href="{{ route('handover_registration.list_user', ['id_period' => $id_period]) }}" class="btn btn-warning mr-2">Trở về</a>
                @if ($registrations->contains('received_at', null))
                  <button type="submit" class="btn btn-primary">Lưu</button>
                @endif
              </form>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
@section('tag_head')
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('script')
  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@endsection
