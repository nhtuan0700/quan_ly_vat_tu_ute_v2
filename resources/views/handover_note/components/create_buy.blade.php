<h5>Danh sách bàn giao văn phòng phẩm</h5>
<table class="table">
  <tr>
    <th>STT</th>
    <th>Tên văn phòng phẩm</th>
    <th>Đơn vị tính</th>
    <th>Giá</th>
    <th class="text-center">Số lượng yêu cầu</th>
    <th class="text-center">Số lượng đã bàn giao</th>
    <th class="text-center">Số lượng bàn giao</th>
  </tr>
  <tbody>
    @php
      $i = 1;
    @endphp
    @foreach ($request_note->detail_buy()->whereRaw('qty > qty_handovered')->get() as $item)
      <tr>
        <th>{{ $i++ }}</th>
        <td>{{ $item->stationery->name }}</td>
        <td>{{ $item->stationery->unit }}</td>
        <td>
          {{ format_currency($item->cost) }}
        </td>
        <td class="text-center">{{ $item->qty }}</td>
        <td class="text-center">
          {{ $item->qty_handovered }}
        </td>
        <td>
          <input class="form-control w-25 text-center m-auto" name="stationeries[{{ $item->id_stationery }}]"
            type="number" step="1" value="0"/>
        </td>
      </tr>
    @endforeach
  </tbody>
</table> 