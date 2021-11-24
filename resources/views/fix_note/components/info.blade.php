<div class="form-row">
  <div class="form-group col-md-3">
    <label>Mã phiếu:</label>
    <p>{{ $note->id }}</p>
  </div>
  <div class="form-group col-md-3">
    <label>Ngày tạo phiếu:</label>
    <p>{{ $note->created_at }}</p>
  </div>
  <div class="form-group col-md-3">
    <label>Trạng thái phiếu:</label>
    <p>{!! $note->statusHTML !!}</p>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-3">
    <label>Người đề nghị:</label>
    <p>{{ $note->creator->name }}</p>
  </div>
  <div class="form-group col-md-3">
    <label>Đơn vị:</label>
    <p>{{ $note->department->name }}</p>
  </div>
</div>
<div class="form-row">
  @if ($note->status !== $StatusNote::PROCESSING)
    <div class="form-group col-md-3">
      <label>Cán bộ xử lý:</label>
      <p>{{ optional($note->handler)->name }}</p>
    </div>
    <div class="form-group col-md-3">
      <label>Ngày xử lý:</label>
      <p>{{ $note->processed_at }}</p>
    </div>
  @endif
  <div class="form-group col-md-3">
    <label>Loại phiếu:</label>
    <p>{{ $note->category }}</p>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label>Ghi chú:</label>
    <p>
      {{ $note->description }}
    </p>
  </div>
</div>