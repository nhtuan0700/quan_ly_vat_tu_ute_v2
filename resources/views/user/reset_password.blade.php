@extends('master')
@section('title')
Quản lý người dùng
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex  align-items-center">
                  <span class="card-title mr-3">Đặt lại mật khẩu</span>
                </div>
              </div>
              <div class="card-body">

                <form method="POST" action="{{ route('user.reset_password', ['id'=> $id]) }}">
                  @csrf
                  @method('put')
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="password">Mật khẩu mới:</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                      @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="password_confirmation ">Xác nhận mật khẩu:</label>
                      <input type="password" class="form-control" id="password_confirmation " name="password_confirmation">
                    </div>
                  </div>
                  <a class="btn btn-warning mr-2" href="{{ url()->previous() }}">Quay lại</a>
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