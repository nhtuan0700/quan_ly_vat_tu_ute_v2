@extends('master')
@section('title')
Quản lý thiết bị
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
                  <form method="POST" action="{{ route('thietbi.update', ['id' => $thietbi->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label>ID:</label>
                        <input type="text" class="form-control" value="{{ $thietbi->id }}" disabled>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="created_at">Thời gian tạo:</label>
                        <input type="text" class="form-control" id="created_at" value="{{ $thietbi->created_at }}" disabled>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="updated_at">Thời gian cập nhật:</label>
                        <input type="text" class="form-control" id="updated_at" value="{{ $thietbi->updated_at }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{ old('name') ?? $thietbi->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="phong">Phòng:</label>
                        <input type="text" class="form-control @error('phong') is-invalid @enderror" id="phong"
                          name="phong" value="{{ old('phong') ?? $thietbi->phong }}">
                        @error('phong')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label>Trạng thái:</label>
                        <p>{{ $thietbi->statusText }}</p>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="ngay_mua">Ngày mua:</label>
                        <div class="input-group date" id="ngay_mua" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#ngay_mua" 
                            name="ngay_mua" autocomplete="off"/>
                          <div class="input-group-append" data-target="#ngay_mua" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('ngay_mua')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="ngay_cap">Ngày cấp:</label>
                        <div class="input-group date" id="ngay_cap" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#ngay_cap" 
                            name="ngay_cap" autocomplete="off"/>
                          <div class="input-group-append" data-target="#ngay_cap" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('ngay_cap')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <a href="{{ route('thietbi.index') }}" class="btn btn-warning mr-2">Trở về</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/vi.js') }}"></script>
<script>
  $(function () {
    $('#ngay_mua').datetimepicker({ 
      icons: { time: 'far fa-clock' },
      locale: 'vi',
      format: 'L'
    });

    $('#ngay_cap').datetimepicker({
      icons: { time: 'far fa-clock' },
      locale: 'vi',
      format: 'L'
    });
    
    var ngay_mua = `{{ old('ngay_mua') }}` || `{{ $thietbi->ngay_mua }}`;
    $("#ngay_mua input").val(ngay_mua);
    var ngay_cap = `{{ old('ngay_cap') }}` || `{{ $thietbi->ngay_cap }}`;
    $("#ngay_cap input").val(ngay_cap);
  })
</script>
@endsection