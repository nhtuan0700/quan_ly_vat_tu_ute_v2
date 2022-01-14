@extends('master')
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div>
            <p class="card-title mr-3">Hạn mức đăng ký văn phòng phẩm của tôi</p>
          </div>
        </div>
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-2">
              <span><b>Quý: </b>{{ quarter_of_year() }}</span>
            </div>
            <div class="form-group col-2">
              <span><b>Năm: </b>{{ now()->year }}</span>
            </div>
          </div>
          <div>
            <span><b>Thời gian hạn mức áp dụng </b>
              (Quý {{ quarter_of_year() }}: {{ range_time_in_quarter() }})
            </span>
          </div>
          <div>
            <input class="form-control float-right w-25 mb-3" id="key-search" placeholder="Tên văn phòng phẩm ...">
            <table class="table table-hover text-nowrap">
              <thead>
                <th scope="col">Mã</th>
                <th scope="col">Tên</th>
                <th scope="col">Đơn vị tính</th>
                <th scope="col" class="text-center">Đã sử dụng</th>
                <th scope="col" class="text-center">Tối đa</th>
                @if($limit_updating)
                  <th scope="col" class="text-center">Đang yêu cầu cập nhật</th>
                @endif
              </thead>
              <tbody>
                @foreach ($limit_stationeries as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->unit }}</td>
                    <td class="text-center">{{ intval($item->qty_used) }}</td>
                    <td class="text-center">{{ intval($item->qty_max) }}</td>
                    @if($limit_updating)
                      <td class="text-center">{{ $item->qty_update }}</td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/nonAccentVietnamese.js') }}"></script>
  <script>
    $(function() {
      $("#key-search").on("keyup", function() {
        var value = $(this).val()
        filterTable(value)
      });
    })

    function filterTable(value) {
      $("table tbody tr").filter(function() {
        $(this).toggle(nonAccentVietnamese($(this).text()).indexOf(nonAccentVietnamese(value)) > -1)
      });
    }
  </script>
@endsection
