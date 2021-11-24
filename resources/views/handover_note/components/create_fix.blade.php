<h5>Danh sách thiết bị đề nghị sửa</h5>
<table class="table">
  <thead>
    <tr>
      <th>Mã thiết bị</th>
      <th>Tên thiết bị</th>
      <th>Phòng</th>
      <th>Lý do sửa</th>
      <th>Chi phí sửa</th>
      <th>Tình trạng sửa</th>
      <th>Bàn giao</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($request_note->detail_fix as $item)
      <tr>
        <th>{{ $item->id_equipment }}</th>
        <td>{{ $item->equipment->name }}</td>
        <td>{{ $item->equipment->room }}</td>
        <td>{{ $item->reason }}</td>
        <td>{{ format_currency($item->cost) }}</td>
        <td>
          {{ $item->statusText }}
        </td>
        <td>
          <div class="form-check">
            @if ($item->is_handovered)
              <span class="text-success"><i class="fas fa-check"></i></span>
            @else
              @if (!is_null($item->is_fixable))
                <div class="icheck-success d-inline">
                  <input type="checkbox" id="equipment{{$item->id_equipment}}" name="equipments[{{ $item->id_equipment }}]">
                  <label for="equipment{{$item->id_equipment}}">
                  </label>
                </div>
              @endif
            @endif
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>