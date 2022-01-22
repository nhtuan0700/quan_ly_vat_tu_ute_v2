@extends('master')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex  align-items-center">
                <span class="card-title mr-2">Thông tin tài khoản</span>
                <a href="{{ route('profile.show_password') }}" class="btn btn-secondary">Đổi mật khẩu</a>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('profile.update_info') }}" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                  {{-- ID --}}
                  <div class="form-group col-md-3">
                    <label for="id">Mã:</label>
                    <div>{{ $user->id }}</div>
                  </div>
                </div>
                <div class="form-row">
                  {{-- Name --}}
                  <div class="form-group col-md-3">
                    <label for="name">Họ Tên:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                      value="{{ old('name') ? old('name') : $user->name }}" rules="required">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dob">Ngày sinh:</label>
                    <div class="input-group date" id="dob" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="dob"
                        autocomplete="off"  rules="required|date"/>
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
                    <label for="id_card">CMND:</label>
                    <input type="text" class="form-control @error('id_card') is-invalid @enderror" id="id_card"
                      name="id_card" value="{{ old('id_card') ? old('id_card') : $user->id_card }}" maxlength="9" rules="required">
                    @error('id_card')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  {{-- Phone number --}}
                  <div class="form-group col-md-3">
                    <label for="tel">Số điện thoại:</label>
                    <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel"
                      value="{{ old('tel') ? old('tel') : $user->tel }}" maxlength="10" rules="required|phone">
                    @error('tel')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                  {{-- Email --}}
                  <div class="form-group col-md-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                      value="{{ $user->email }}" disabled>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="department">Đơn vị:</label>
                    <div>{{ $user->department->name }}</div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="department">Đơn vị:</label>
                    <div>{{ $user->position->name }}</div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="role">Vai trò:</label>
                    <div>{{ $user->role->name }}</div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection


@section('tag_head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('js/vi.js') }}"></script>
  <script src="{{ asset('js/validator.js') }}"></script>
  <script>
    $(function() {
      const validator = new Validator('form');
      $('#dob').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        locale: 'vi',
        format: 'L'
      });
      var d = new Date()
      var dob = `{{ old('dob') }}` || `{{ $user->dob }}`
      $("#dob input").val(dob);
    })
  </script>
@endsection
