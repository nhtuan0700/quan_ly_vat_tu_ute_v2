<div class="modal fade" id="modalHanMuc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hạn mức văn phòng phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input class="form-control float-right w-25 mb-3" id="key-search" placeholder="Tên văn phòng phẩm ...">
        <form action="{{ route('user.update_limit', ['id_user' => $user->id]) }}" method="post" id="form-limit">
          @csrf
          <div class="card-body table-responsive p-0" style="height: 400px;">
            <table  class="table table-head-fixed text-nowrap" id="limit">
              <thead>
                <th scope="col">#</th>
                <th scope="col">Tên</th>
                <th scope="col">Đơn vị tính</th>
                <th scope="col" width="20%" class="text-center">Đã sử dụng</th>
                <th scope="col" width="20%">Tối đa</th>
              </thead>
              <tbody>
                @php
                  $index = 1;
                @endphp
                @foreach ($limit_stationeries as $item)
                  <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->unit }}</td>
                    <td class="text-center">{{ $item->qty_used }}</td>
                    <td>
                      <input class="form-control" type="number" name="limits[{{ $item->id }}]"
                        value="{{ $item->qty_max }}">
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="form-limit">Cập nhật</button>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $(function() {
      $("#key-search").on("keyup", function() {
        var value = $(this).val()
        filterTable(value)
      });
    })

    function filterTable(value) {
      value = value.toLowerCase()
      $("#limit tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    }
  </script>
@endpush
