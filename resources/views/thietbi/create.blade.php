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
                          name="id" value="{{ old('id') }}">
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