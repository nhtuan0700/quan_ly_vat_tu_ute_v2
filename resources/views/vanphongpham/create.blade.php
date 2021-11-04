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
                    <p class="card-title mr-3">Tạo mới</p>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('vanphongpham.store') }}">
                    @csrf
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
                        <label for="dvt">Đơn vị tính:</label>
                        <input type="text" class="form-control @error('dvt') is-invalid @enderror" id="dvt"
                          name="dvt" value="{{ old('dvt') }}">
                        @error('dvt')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="hanmuc_tb">Hạn mức trung bình:</label>
                        <input type="text" class="form-control @error('hanmuc_tb') is-invalid @enderror" 
                          id="hanmuc_tb" name="hanmuc_tb"
                          value="{{ old('hanmuc_tb') }}">
                        @error('hanmuc_tb')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="danhmuc">Danh mục:</label>
                        <select id="danhmuc" class="form-control  @error('id_danhmuc') is-invalid @enderror" name="id_danhmuc">
                          @foreach ($list_danhmuc as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                        @error('id_danhmuc')
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