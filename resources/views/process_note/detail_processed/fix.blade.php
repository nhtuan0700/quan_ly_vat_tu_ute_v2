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
                    <thead>
                      <tr>
                        <th>Mã thiết bị</th>
                        <th>Tên thiết bị</th>
                        <th>Phòng</th>
                        <th>Lý do sửa</th>
                        @if ($note->status !== $StatusNote::REJECTED)
                          <th>Tình trạng</th>
                        @endif
                        @can('view_handover', $note)
                          @php($can_view_handover = true)
                        @else
                          @php($can_view_handover = false)
                        @endcan
                        @if ($can_view_handover)
                          <th>Tình trạng sửa</th>
                          <th width="15%">Chi phí sửa</th>
                          <th class="text-center">Bàn giao</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($note->detail_fix as $item)
                        <tr>
                          <th>{{ $item->id_equipment }}</th>
                          <td>{{ $item->equipment->name }}</td>
                          <td>{{ $item->equipment->room }}</td>
                          <td>{{ $item->reason }}</td>
                          @if ($note->status !== $StatusNote::REJECTED)
                            <td>
                              {{ $item->equipment->statusText }}
                            </td>
                          @endif
                          @if ($can_view_handover)
                            @if (!$item->is_handovered)
                              <td>
                                <select name="equipments[{{ $item->id_equipment }}][is_fixable]" class="form-control">
                                  <option value>Chờ sửa</option>
                                  <option value="1" @if ($item->is_fixable === 1) selected @endif>Sửa được</option>
                                  <option value="0" @if ($item->is_fixable === 0) selected @endif>Không sửa được</option>
                                </select>
                              </td>
                              <td>
                                <div class="input-group pr-3">
                                  <input type="text" class="form-control d-inline w-75"
                                    name="equipments[{{ $item->id_equipment }}][cost]" autocomplete="off"
                                    data-type="currency" value="{{ $item->cost }}">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">đ</span>
                                  </div>
                                </div>
                              </td>
                              <td></td>
                            @else
                              <td>{{ $item->is_fixable ? 'Sửa được' : 'Không sửa được' }}</td>
                              <td>
                                {{ format_currency($item->cost) }}
                              </td>
                              <td class="text-center">
                                <span class="text-success"><i class="fas fa-check"></i></span>
                              </td>
                            @endif
                          @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
                <a href="{{ route('process_note.index') }}" class="btn btn-default mr-1">Trở về</a>
                @can('view_handover', $note)
                  <button type="button" class="btn btn-default mr-1" data-toggle="modal" data-target="#modalListHandover">
                    Lịch sử bàn giao</button>
                  @include('handover_note.components.modal_list', ['handover_notes' => $note->handover_notes])
                @endcan
                @can('update_detail_fix', $note)
                  <button type="submit" class="btn btn-primary mr-1">Cập nhật</button>
                @endcan
                @if (auth()->user()->can('create_handover', $note))
                  <a href="{{ route('handover_note.create', ['id_request_note' => $note->id]) }}"
                    class="btn btn-success">Tạo phiếu bàn giao</a>
                @endif
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
      $(`select[name*='[is_fixable]']`).each(function(item) {
        if (!parseInt($(this).val())) {
          $(this).closest('tr').find('input').attr('readonly', 'on');
        }
      });

      $(`select[name*='[is_fixable]']`).change(function() {
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
