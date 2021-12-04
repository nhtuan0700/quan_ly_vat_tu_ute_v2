@extends('master')
@section('title')
Quản lý thiết bị
@endsection
@section('content')
<section class="content">
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
            <form method="POST" action="{{ route('equipment.store') }}">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="id">Mã: <span class="text-primary text-sm">(Nếu bỏ trống id sẽ tự động tạo mới)</span></label>
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
                  <label for="room">Phòng:</label>
                  <input type="text" class="form-control @error('room') is-invalid @enderror" id="room"
                    name="room" value="{{ old('room') }}">
                  @error('room')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="date_buy">Ngày mua:</label>
                  <div class="input-group date" id="date_buy" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#date_buy" 
                      name="date_buy" autocomplete="off"/>
                    <div class="input-group-append" data-target="#date_buy" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  @error('date_buy')
                  <div class="invalid-feedback d-block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="date_grant">Ngày cấp:</label>
                  <div class="input-group date" id="date_grant" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#date_grant" 
                      name="date_grant" autocomplete="off" value="{{ old('date_grant') }}"/>
                    <div class="input-group-append" data-target="#date_grant" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  @error('date_grant')
                  <div class="invalid-feedback d-block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <a class="btn btn-default mr-1" href="{{ route('equipment.index') }}">Quay lại</a>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('tag_head')
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/vi.js') }}"></script>
<script>
  $(function () {
    $('#date_buy').datetimepicker({ 
      icons: { time: 'far fa-clock' },
      locale: 'vi',
      format: 'L'
    });
    
    $('#date_grant').datetimepicker({
      icons: { time: 'far fa-clock' },
      locale: 'vi',
      format: 'L'
    });

    var d = new Date();
    var date = ("0" + d.getDate()).slice(-2);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear();
    
    var date_buy = `{{ old('date_buy') }}` || `${date}/${month}/${year}`;
    $("#date_buy input").val(date_buy);
  })
</script>
@endsection