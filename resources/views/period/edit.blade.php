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
                  <div>
                    <span class="text-warning mb-0 mr-1">Chú ý</span>
                    <p class="m-0">
                      - Nếu đợt đăng ký quá thời gian áp dụng thì không thể chỉnh sửa hoặc xóa
                    </p>
                    <p class="m-0">
                      - Nếu đợt đăng ký đang diễn ra thì không thể chỉnh sửa <b>ngày bắt đầu</b>
                    </p>
                  </div>
                  <form method="POST" action="{{ route('period.update', ['id' => $period->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="">ID</label>
                        <input type="text" class="form-control" value="{{ $period->id }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="">Thời gian tạo</label>
                        <input type="text" class="form-control" value="{{ $period->created_at }}" disabled>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="">Thời gian cập nhật</label>
                        <input type="text" class="form-control" value="{{ $period->updated_at }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="start_time">Thời gian bắt đầu:</label>
                        <div class="input-group date" id="start_time" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#start_time" 
                            name="start_time" autocomplete="off" 
                            @if ($disabled_start) disabled @endif/>
                          <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('start_time')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="end_time">Thời gian kết thúc:</label>
                        <div class="input-group date" id="end_time" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#end_time" 
                            name="end_time" autocomplete="off" 
                            @cannot('edit', $period) disabled @endcannot/>
                          <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('end_time')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    @can ('edit', $period)
                      <button type="submit" class="btn btn-primary pr-4 pl-4">Lưu</button>
                    @endcan
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
    
    $('#start_time').datetimepicker({ 
      icons: { time: 'far fa-clock' },
      locale: 'vi',
    });
    var d = new Date()
    var start_time = `{{ old('start_time') }}` || `{{ $period->start_time }}`
    $("#start_time input").val(start_time);

    $('#end_time').datetimepicker({
      icons: { time: 'far fa-clock' },
      locale: 'vi'
    });
    var end_time = `{{ old('end_time') }}` || `{{ $period->end_time }}`
    $("#end_time input").val(end_time);
  })
</script>
@endsection