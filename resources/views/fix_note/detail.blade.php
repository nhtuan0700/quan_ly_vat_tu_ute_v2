@extends('master')
@section('title')
  Quản lý phiếu sửa
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
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
                    @include('fix_note.components.info', ['note' => $note])
                    <hr>
                    <div>
                      <h5>Danh sách thiết bị đề nghị sửa</h5>
                      <table class="table">
                        <tr>
                          <th>Mã thiết bị</th>
                          <th>Tên thiết bị</th>
                          <th>Phòng</th>
                          <th>Lý do sửa</th>
                          <th>Chi phí sửa</th>
                          @if ($note->status !== $StatusNote::REJECTED)
                            <th>Tình trạng sửa</th>
                          @endif
                          @can('view_handover', $note)
                            @php($can_view_handover = true)
                          @else
                            @php($can_view_handover = false)
                          @endcan
                          @if ($can_view_handover)
                            <th class="text-center">Bàn giao</th>
                          @endif
                        </tr>
                        <tbody>
                          @foreach ($note->detail_fix as $item)
                            <tr>
                              <th>{{ $item->id_equipment }}</th>
                              <td>{{ $item->equipment->name }}</td>
                              <td>{{ $item->equipment->room }}</td>
                              <td>{{ $item->reason }}</td>
                              <td>{{ format_currency($item->cost) }}</td>
                              @if ($note->status !== $StatusNote::REJECTED)
                                <td>
                                  {{ $item->statusText }}
                                </td>
                              @endif
                              @if ($can_view_handover)
                                @if ($item->is_handovered)
                                  <td class="text-center">
                                    <span class="text-success"><i class="fas fa-check"></i></span>
                                  </td>
                                @else
                                  <td></td>
                                @endif
                              @endif
                            </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <a href="{{ route('fix_note.index') }}" class="btn btn-warning mr-2">Trở về</a>
                    @can('view_handover', $note)
                      <button type="button" class="btn btn-default mr-2" data-toggle="modal"
                        data-target="#modalListHandover">
                        Lịch sử bàn giao</button>
                      @include('handover_note.components.modal_list', ['handover_notes' => $note->handover_notes])
                    @endcan
                    @can('update_fix', $note)
                      <a href="{{ route('fix_note.edit', ['id' => $note->id]) }}" class="btn btn-info mr-2">Sửa</a>
                    @endcan
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@section('script')
  @stack('js')
@endsection
