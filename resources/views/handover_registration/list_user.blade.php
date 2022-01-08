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
                <span class="card-title mr-3">Danh sách đã đăng ký</span>
              </div>
            </div>

            <div class="card-body pb-0">
              {{-- Search --}}
              <form method="GET" action="{{ route('user.search') }}">
                <div class="form-row form-row-0">
                  {{-- ID --}}
                  <div class="form-group col-md-2">
                    <label for="id">Mã:</label>
                    <input type="number" class="form-control" id="id" name="id" value="{{ request()->id ?? '' }}"
                      autocomplete="off">
                  </div>
                </div>
              </form>
            </div>

            <div class="card-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Họ Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Đơn vị</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Bàn giao</th>
                    <th scope="col" class="fit">Thao tác</th>
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
                      <td>{{ $item->position->name }}</td>
                      <td>
                        {{ $item->handovered_count > 0 ? 'Chưa đủ' : 'Đủ' }}
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('handover_registration.detail', ['id_period' => $id_period, 'id_user' => $item->id]) }}"
                            class="btn btn-info">Xem</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
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
      $("input[name=id]").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    })
  </script>
@endsection
