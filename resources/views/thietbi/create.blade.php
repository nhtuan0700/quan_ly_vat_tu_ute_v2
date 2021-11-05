@extends('master')
@section('title')
Quản lý văn phòng phẩm
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
                  <form method="POST" action="{{ route('thietbi.store') }}">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="id">ID: <span class="text-primary text-sm">(Nếu bỏ trống id sẽ tự động tạo mới)</span></label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" id="id"
                          name="id" value="{{ old('id') ?? $new_id }}">
                        @error('id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="phong">Phòng:</label>
                        <input type="text" class="form-control @error('phong') is-invalid @enderror" id="phong"
                          name="phong" value="{{ old('phong') }}">
                        @error('phong')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
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
                    <button type="submit" class="btn btn-primary">Lưu</button>
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

    var d = new Date();
    var date = ("0" + d.getDate()).slice(-2);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear();
    
    var ngay_mua = `{{ old('ngay_mua') }}` || `${date}/${month}/${year}`;
    $("#ngay_mua input").val(ngay_mua);
    var ngay_cap = `{{ old('ngay_cap') }}` || `${date}/${month}/${year}`;
    $("#ngay_cap input").val(ngay_cap);
  })
</script>
@endsection