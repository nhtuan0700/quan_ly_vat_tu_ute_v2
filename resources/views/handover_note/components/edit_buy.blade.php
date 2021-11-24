<h5>Danh sách tổng hợp đăng ký văn phòng phẩm của đơn vị </h5>
<table class="table">
  <thead>
    <tr>
      <th>STT</th>
      <th>Tên văn phòng phẩm</th>
      <th>Đơn vị tính</th>
      <th>Giá</th>
      <th class="text-center">Số lượng yêu cầu</th>
      <th class="text-center">Số lượng đã bàn giao</th>
      <th class="text-center">Số lượng bàn giao</th>
    </tr>
  </thead>
  <tbody>
    @php
      $i = 1;
    @endphp
    @foreach ($note->detail_handover_buy2($is_edit = true) as $item)
      <tr>
        <th>{{ $i++ }}</th>
        <td>{{ $item->name }}</td>
        <td>{{ $item->unit }}</td>
        <td>{{ $item->cost }}</td>
        <td class="text-center">
          {{ $item->qty }}
        </td>
        <td class="text-center">
          {{ $item->qty_handovered }}
        </td>
        <td class="text-center">
          <input class="form-control w-25 text-center m-auto" 
            name="stationeries[{{ $item->id_stationery }}]"
            type="number" step="1" value="{{ $item->qty_handovering ?? 0 }}"/>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>