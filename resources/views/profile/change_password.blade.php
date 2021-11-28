@extends('master')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex  align-items-center">
                <span class="card-title mr-2">Đổi mật khẩu</span>
              </div>
            </div>
            <div class="card-body">
              <form class="join" action="{{ route('profile.update_password') }}" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                  <div class="form-group col-md-4 @error('current_password') has-error @enderror">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control" />
                    @error('current_password')
                      <div class="text-danger">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4 @error('password') has-error @enderror">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" />
                    @error('password')
                      <div class="text-danger">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                    <input type="password" name="password_confirmation" class="form-control" />
                  </div>
                </div>
                <a href="{{ route('profile.info') }}" class="btn btn-warning mr-2">Trở về</a>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
