{{-- Status --}}
<div class="form-group col-md-3">
  <label for="status">Status: </label>
  @if ($user->status)
  <span class="text-success">{{ $user->displayStatus() }}</span>
  <div>
    <button class="btn btn-danger" id="block_user" data-toggle="modal" data-target="#modalBlock">Block</button>
  </div>
  @else
  <span class="text-danger">{{ $user->displayStatus() }}</span>
  <div>
    <button class="btn btn-success" id="active_user" data-toggle="modal" data-target="#modalActive">Reactive</button>
  </div>
  @endif

  @push('modal')
  @if ($user->status)
  {{-- Modal block --}}
  <div class="modal fade" id="modalBlock" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reason for blocking account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.user.block', ['id' => $user->id]) }}" method="POST" id="form-block">
            @method('put')
            @csrf
            @foreach ($reason_blockeds as $index => $item)
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_reason" value="{{ $item->id }}"
                id="reason-{{ $item->id }}" @if ($index==0) checked @endif>
              <label class="form-check-label" for="reason-{{ $item->id }}">
                {{ $item->description }}
              </label>
            </div>
            @endforeach
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" form="form-block" value="Block" class="btn btn-primary" />
        </div>
      </div>
    </div>
  </div>

  @else
  {{-- Modal Active --}}
  <div class="modal fade" id="modalActive" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reason for blocking account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.user.active', ['id' => $user->id]) }}" method="POST" id="form-active">
            @method('put')
            @csrf
            <p class="text-danger">{{ $user->getReasonBlocked() }}</p>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" form="form-active" value="Reactive" class="btn btn-primary" />
        </div>
      </div>
    </div>
  </div>
  @endif

  @endpush
</div>
@push('js')
<script>
  $('#block_user').click(function(e) {
    e.preventDefault()
  })
  $('#active_user').click(function(e) {
    e.preventDefault()
  })
</script>
@endpush