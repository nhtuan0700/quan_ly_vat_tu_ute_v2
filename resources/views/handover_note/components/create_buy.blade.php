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
          <div class="form-group w-25 m-auto">
            <input class="form-control text-center" name="stationeries[{{ $item->id_stationery }}]"
             type="number" step="1" value="0" rules="required|integer|min:0|max:{{ $item->qty - $item->qty_handovered }}"/>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table> 

@push('js')
  <script src="{{ asset('js/validator.js') }}"></script>
  <script>
    $(function () {
      let is_valid = false;
      const validator = new Validator('form')
      document.querySelector('form').onsubmit = function (e) {
        e.preventDefault()
        $("[name^='stationeries']").each(function () {
          let value = parseInt($(this).val());
          if (value > 0) {
            is_valid = true;
          }
        })
        
        if (is_valid) {
          this.submit()
        } else {
          toastr.error('Danh sách bàn giao chưa hợp lệ')
        }
      }
    })
  </script>
@endpush