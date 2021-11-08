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
                    <p class="card-title mr-3">Tạo mới</p>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('dotdangky.store') }}">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="start_at">Thời gian bắt đầu:</label>
                        <div class="input-group date" id="start_at" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#start_at" 
                            name="start_at" autocomplete="off"/>
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
                            name="end_at" autocomplete="off"/>
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
                    @if ($is_coming)
                      <p class="text-danger">Đợt đăng ký mới sắp diễn ra nên không thể tạo thêm</p>
                      {{-- <button type="submit" class="btn btn-primary pr-4 pl-4">Lưu</button> --}}
                    @else
                      <button type="submit" class="btn btn-primary pr-4 pl-4">Lưu</button>
                    @endif
                  </form>
                  <div>
                    <span class="text-warning mb-0 mr-1">Chú ý</span>
                    <p>
                      Nếu có đợt đăng ký mới sắp diễn ra thì không thể tạo thêm
                    </p>
                  </div>
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
    var d = new Date();
    var date = ("0" + d.getDate()).slice(-2);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear();
    
    var start_at = `{{ old('start_at') }}` || `${date}/${month}/${year} 00:00`;
    $("#start_at input").val(start_at);

    $('#end_at').datetimepicker({
      icons: { time: 'far fa-clock' },
      locale: 'vi'
    });

    var end_at = `{{ old('end_at') }}` || `${date}/${month}/${year} 23:59`;
    $("#end_at input").val(end_at);
  })
</script>
@endsection