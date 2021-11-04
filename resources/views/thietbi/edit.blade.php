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
                        <label for="id">ID:</label>
                        <input type="text" class="form-control @error('id') is-invalid @enderror" id="id"
                          name="id" value="{{ old('id') ?? $thietbi->id }}">
                        @error('id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
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