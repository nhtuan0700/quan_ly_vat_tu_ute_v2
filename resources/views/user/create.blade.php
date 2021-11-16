@extends('master')
@section('title')
Quản lý người dùng
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
                  <form method="POST" action="{{ route('user.create') }}">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="name">Họ Tên:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="id_card">CMND:</label>
                        <input type="text" class="form-control @error('id_card') is-invalid @enderror" id="id_card"
                          name="id_card" value="{{ old('id_card') }}" maxlength="9">
                        @error('id_card')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="tel">Số điện thoại:</label>
                        <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel"
                          value="{{ old('tel') }}" maxlength="10">
                        @error('tel')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="dob">Ngày sinh:</label>
                        <div class="input-group date" id="dob" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#dob" 
                            name="dob" autocomplete="off"/>
                          <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('dob')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                          name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                          id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="role">Vai trò:</label>
                        <select id="role" class="form-control  @error('id_role') is-invalid @enderror" name="id_role">
                          @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if($role->id == old('id_role')) selected @endif>
                              {{ $role->name }}
                            </option>
                          @endforeach
                        </select>
                        @error('id_role')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-group col-md-3">
                        <label for="donvi">Đơn vị:</label>
                        <select id="donvi" class="form-control select2 @error('id_department') is-invalid @enderror"
                          name="id_department">
                          @foreach ($departments as $item)
                            <option value="{{ $item->id }}" @if ($item->id == old('id_department')) selected @endif>
                              {{ $item->name }}
                            </option>
                          @endforeach
                        </select>
                        @error('id_department')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pr-4 pl-4 ">Lưu</button>
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

    $('#dob').datetimepicker({ 
      icons: { time: 'far fa-clock' },
      locale: 'vi',
      format: 'L'
    });
    var d = new Date();
    var date = ("0" + d.getDate()).slice(-2);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = 2000;
    
    var dob = `{{ old('dob') }}` || `${date}/${month}/${year}`;
    $("#dob input").val(dob);
  })
</script>
@endsection