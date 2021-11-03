@extends('master')
@section('title')
Quản lý đợt đăng ký
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
                  <form method="POST" action="{{ route('dotdangky.update', ['id' => $dotdangky->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="">ID</label>
                        <input type="text" class="form-control" value="{{ $dotdangky->id }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="">Thời gian tạo</label>
                        <input type="text" class="form-control" value="{{ $dotdangky->created_at }}" disabled>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="">Thời gian cập nhật</label>
                        <input type="text" class="form-control" value="{{ $dotdangky->updated_at }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="start_at">Thời gian bắt đầu:</label>
                        <div class="input-group date" id="start_at" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#start_at" 
                            name="start_at" autocomplete="off" 
                            @if ($disable_start_at || !$dotdangky->canEdit()) disabled @endif/>
                          <div class="input-group-append" data-target="#start_at" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('start_at')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="end_at">Thời gian kết thúc:</label>
                        <div class="input-group date" id="end_at" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#end_at" 
                            name="end_at" autocomplete="off" 
                            @if(!$dotdangky->canEdit()) disabled @endif/>
                          <div class="input-group-append" data-target="#end_at" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('end_at')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    @if ($dotdangky->canEdit())
                      <button type="submit" class="btn btn-primary pr-4 pl-4">Lưu</button>
                    @endif
                  </form>
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

@section('tag_head')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/vi.js') }}"></script>
<script>
  $(function () {
    $('.select2').select2()
    
    $('#start_at').datetimepicker({ 
      icons: { time: 'far fa-clock' },
      locale: 'vi',
    });
    var d = new Date()
    var start_at = `{{ old('start_at') }}` || `{{ $dotdangky->start_at }}`
    $("#start_at input").val(start_at);

    $('#end_at').datetimepicker({
      icons: { time: 'far fa-clock' },
      locale: 'vi'
    });
    var end_at = `{{ old('end_at') }}` || `{{ $dotdangky->end_at }}`
    $("#end_at input").val(end_at);
  })
</script>
@endsection