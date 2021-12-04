<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">
          Danh sách chi tiết đăng ký của đơn vị {{ $department_name }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Mã cán bộ</th>
            <th>Tên cán bộ</th>
            <th>Đơn vị</th>
            <th>Tên văn phòng phẩm</th>
            <th>Đơn vị tính</th>
            <th class="text-center">Số lượng yêu cầu</th>
          </tr>
          <tbody>
            @foreach ($depm_registrations as $item)
              <tr>
                <th>{{ $item->id_user }}</th>
                <td>{{ $item->name_user }}</td>
                <td>{{ $item->name_department }}</td>
                <td>{{ $item->name_stationery }}</td>
                <td>{{ $item->unit }}</td>
                <td class="text-center">{{ $item->qty }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
