<div class="row">
  <div class="col-md-3">
    <label>Mã phiếu bàn giao:</label>
    <p>{{ $note->id }}</p>
  </div>
  <div class="col-md-3">
    <label>Người tạo phiếu bàn giao:</label>
    <p>{{ $note->creator->name }}</p>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <label>Mã phiếu đề nghị:</label>
    <p>
      {{ $note->request_note->id }}
      </a>
    </p>
  </div>
  <div class="col-md-3">
    <label>Người tạo phiếu đề nghị:</label>
    <p>{{ $note->request_note->creator->name }}</p>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <label>Ngày tạo phiếu bàn giao:</label>
    <p>{{ $note->created_at }}</p>
  </div>
  <div class="col-md-3">
    <label>Trạng thái:</label>
    <p>{{ $note->statusText }}</p>
  </div>
</div>
<hr>
<div>
  @if ($note->request_note->is_buy)
    @include('handover_note.components.detail_buy', ['note' => $note])
  @else
    @include('handover_note.components.detail_fix')
  @endif
</div>
<a href="#" class="btn btn-secondary mr-2">In phiếu</a>
