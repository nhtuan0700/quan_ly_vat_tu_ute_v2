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
                  <form method="POST" action="{{ route('stationery.update', ['id' => $stationery->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{ old('name') ?? $stationery->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="unit">Đơn vị tính:</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit"
                          name="unit" value="{{ old('unit') ?? $stationery->unit }}">
                        @error('unit')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-2">
                        <label for="limit_avg">Hạn mức trung bình:</label>
                        <input type="number" class="form-control @error('limit_avg') is-invalid @enderror" 
                          id="limit_avg" name="limit_avg"
                          value="{{ old('limit_avg') ?? $stationery->limit_avg }}">
                        @error('limit_avg')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="category">Danh mục:</label>
                        <select id="category" class="form-control  @error('id_category') is-invalid @enderror" name="id_category">
                          @foreach ($categories as $item)
                            <option value="{{ $item->id }}" @if ($item->id === $stationery->id_category) selected @endif>
                              {{ $item->name }}
                            </option>
                          @endforeach
                        </select>
                        @error('id_category')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                    </div>
                    <a href="{{ route('stationery.index') }}" class="btn btn-warning mr-2">Trở về</a>
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