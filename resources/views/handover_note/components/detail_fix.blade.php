<h5>Danh sách bàn giao thiết bị</h5>
<table class="table">
  <thead>
    <tr>
      <th>Mã thiết bị</th>
      <th>Tên thiết bị</th>
      <th>Phòng</th>
      <th>Lý do sửa</th>
      <th>Chi phí sửa</th>
      <th>Tình trạng sửa</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($note->detail_handover_fix2() as $item)
      <tr>
        <th>{{ $item->id_equipment }}</th>
        <td>{{ $item->name }}</td>
        <td>{{ $item->room }}</td>
        <td>{{ $item->reason }}</td>
        <td>{{ format_currency($item->cost) }}</td>
        <td>
          @if ($item->is_fixable === 1)
            Sửa được
          @else
            Không sửa được
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>