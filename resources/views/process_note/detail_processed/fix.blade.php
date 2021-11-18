@extends('master')
@section('title')
Xét duyệt phiếu đề nghị
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div>
              <p class="card-title mr-3">Chi tiết</p>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('process_note.update_detail_fix', ['id' => $note->id]) }}" method="post">
              @csrf
              @include('fix_note.components.info', ['note' => $note])
              <hr>
              <div>
                <h5>Danh sách thiết bị đề nghị sửa</h5>
                <table class="table">
                  <tr>
                    <th>Mã thiết bị</th>
                    <th>Tên thiết bị</th>
                    <th>Phòng</th>
                    <th>Tình trạng</th>
                    <th>Lý do sửa</th>
                    @if ($note->status == $StatusNote::CONFIRMED)
                      <th>Tình trạng sửa</th>
                      <th>Chi phí sửa</th>
                    @endif
                  </tr>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($note->detail_fix as $item)
                      <tr>
                        <th>{{ $item->id_equipment }}</th>
                        <td>{{ $item->equipment->name }}</td>
                        <td>{{ $item->equipment->room }}</td>
                        <td>
                          {{ $item->equipment->statusText }}
                        </td>
                        <td>{{ $item->reason }}</td>
                        @if ($note->status == $StatusNote::CONFIRMED)
                          <td>
                            <select name="equipments[{{ $item->id_equipment }}][status]" class="form-control">
                              <option value="1" @if ($item->equipment->status !== 3) selected @endif>Sửa được</option>
                              <option value="0" @if ($item->equipment->status == 3) selected @endif>Không sửa được</option>
                            </select>
                          </td>
                          <td>
                            <div class="input-group pr-3">
                              <input type="text" class="form-control d-inline w-75" name="equipments[{{ $item->id_equipment }}][cost]" 
                                autocomplete="off" data-type="currency" value="{{ $item->cost }}">
                              <div class="input-group-prepend">
                                <span class="input-group-text">đ</span>
                              </div>
                            </div>
                          </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
              <a href="{{ route('process_note.index') }}" class="btn btn-warning mr-2">Trở về</a>
              @can('update_detail_fix', $note)
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              @endcan
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/currency.js') }}"></script>
<script>
  $(function() {
    $(`select[name*='[status]']`).each(function(item) {
      if (!parseInt($(this).val())) {
        $(this).closest('tr').find('input').attr('readonly', 'on');
      }
    });

    $(`select[name*='[status]']`).change(function() {
      let value = parseInt($(this).val());
      if (!value) {
        $(this).closest('tr').find('input').val('');
        $(this).closest('tr').find('input').attr('readonly', 'on');
      } else {
        $(this).closest('tr').find('input').removeAttr('readonly');
      }
    })
  })
</script>
@endsection