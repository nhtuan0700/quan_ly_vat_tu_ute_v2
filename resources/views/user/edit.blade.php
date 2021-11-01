@extends('master')
@section('title')
Quản lý người dùng
@endsection
@section('content')
<section class="content">
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex  align-items-center">
              <span class="card-title mr-3">Chi tiết</span>
              <a href="{{ route('user.reset_password',  ['id'=> $user->id]) }}"
                class="btn btn-secondary mr-3">Đặt lại mật khẩu</a>
              <a href="{{ route('user.create') }}" class="btn btn-success">Tạo mới</a>
            </div>
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('user.update', ['id'=> $user->id]) }}">
              @csrf
              @method('put')
              <div class="form-row">
                {{-- ID --}}
                <div class="form-group col-md-3">
                  <label for="id">ID</label>
                  <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}" disabled>
                </div>
                {{-- Created at --}}
                <div class="form-group col-md-3">
                  <label for="created_at">Thời gian tạo</label>
                  <input type="text" class="form-control" id="created_at" name="created_at"
                    value="{{ $user->created_at }}" disabled>
                </div>
              </div>
              <div class="form-row">
                {{-- Name --}}
                <div class="form-group col-md-3">
                  <label for="name">Họ Tên:</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{old('name') ? old('name') : $user->name}}">
                  @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="cmnd">CMND:</label>
                  <input type="text" class="form-control @error('cmnd') is-invalid @enderror" id="cmnd"
                    name="cmnd" value="{{old('cmnd') ? old('cmnd') : $user->cmnd}}">
                  @error('cmnd')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                {{-- Phone number --}}
                <div class="form-group col-md-3">
                  <label for="tel">Số điện thoại:</label>
                  <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel"
                    value="{{old('tel') ? old('tel') : $user->tel}}" maxlength="10">
                  @error('tel')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="dob">Ngày sinh:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="dob" class="form-control" data-inputmask-alias="datetime"
                      data-inputmask-inputformat="dd/mm/yyyy" data-mask
                      value="{{ $user->dob }}">
                  </div>
                  @error('dob')
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
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ $user->email }}" disabled>
                </div>
                <div class="form-group col-md-3">
                  <label for="email">Đơn vị:</label>
                  <select id="province" class="form-control select2 @error('id_don_vi') is-invalid @enderror"
                    name="id_don_vi">
                    @foreach ($list_donvi as $item)
                      <option value="{{ $item->id }}" @if ($item->id === $user->id_don_vi) selected @endif>
                        {{ $item->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-row">
                {{-- Role --}}
                <div class="form-group col-md-3">
                  <label for="role">Role</label>
                  <select id="role" class="form-control @error('id_role') is-invalid @enderror" name="id_role">
                    @foreach ($roles as $role)
                    @if ($role->id == $user->role->id)
                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @else
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                    @endforeach
                  </select>
                  @error('id_role')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
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
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
  $(function () {
    $('.select2').select2()
    $('[data-mask]').inputmask()
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  })
</script>
@endsection