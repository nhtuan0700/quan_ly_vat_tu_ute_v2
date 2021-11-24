<div class="modal fade" id="modalListHandover" tabindex="0" aria-labelledby="modallabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Lịch sử bàn giao
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Danh sách phiếu bàn giao
        </h5>
        <table class="table">
          <thead>
            <th scope="col">Mã phiếu bàn giao</th>
            <th scope="col">Người tạo phiêu</th>
            <th scope="col">Ngày tạo phiếu bàn giao</th>
            <th scope="col">Trạng thái</th>
            <th></th>
          </thead>
          <tbody>
            @foreach ($handover_notes as $item)
              <tr>
                <th>{{ $item->id }}</th>
                <td>{{ $item->creator->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                  {{ $item->statusText }}
                </td>
                <td>
                  <div class="d-flex justify-content-center">
                    <button type="button" data-toggle="modal" data-target="#modalDetailHandover"
                      class="btn btn-info mr-2 btn-detail" data-id="{{ $item->id }}">Xem</button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@include('handover_note.components.modal_detail')

@push('js')
  <script src="{{ asset('js/ajax.js') }}"></script>
  <script>
    $(function() {
      $('.btn-detail').click(function() {
        const url = `{{ route('handover_note.detail_ajax') }}/${$(this).data('id')}`
        ajax(url, {}, 'GET', function(result) {
          $('#body-content').html(result.html)
        })
      })
    })
  </script>
@endpush
