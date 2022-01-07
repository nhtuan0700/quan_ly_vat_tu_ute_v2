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
                <span class="card-title mr-2">Chi tiết</span>
                <a href="{{ route('user.reset_password', ['id' => $user->id]) }}" class="btn btn-secondary mr-2">Đặt lại
                  mật khẩu</a>
                <button type="button" class="btn btn-default d-block" data-toggle="modal" data-target="#modalHanMuc">
                  Hạn mức văn phòng phẩm
                </button>
              </div>
            </div>

            <div class="card-body">
              <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                @csrf
                @method('put')
                <div class="form-row">
                  {{-- ID --}}
                  <div class="form-group col-md-3">
                    <label for="id">Mã:</label>
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                      value="{{ old('name') ? old('name') : $user->name }}">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="id_card">CMND:</label>
                    <input type="text" class="form-control @error('id_card') is-invalid @enderror" id="id_card"
                      name="id_card" value="{{ old('id_card') ? old('id_card') : $user->id_card }}" maxlength="9">
                    @error('id_card')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  
                </div>
                <div class="form-row">
                  {{-- Phone number --}}
                  <div class="form-group col-md-3">
                    <label for="tel">Số điện thoại:</label>
                    <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel"
                      value="{{ old('tel') ? old('tel') : $user->tel }}" maxlength="10">
                    @error('tel')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dob">Ngày sinh:</label>
                    <div class="input-group date" id="dob" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="dob"
                        autocomplete="off" />
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
                    <select id="department" class="form-control select2 @error('id_department') is-invalid @enderror"
                      name="id_department">
                      @foreach ($departments as $item)
                        <option value="{{ $item->id }}" @if ($item->id === $user->id_department) selected @endif
                          data-room="{{ $item->is_room }}">
                          {{ $item->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  {{-- Chức vụ --}}
                  <div class="form-group col-md-3">
                    <label for="position">Chức vụ:</label>
                    <select id="position" class="form-control @error('id_position') is-invalid @enderror" 
                      name="id_position">
                      
                      @error('id_position')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </select>
                  </div>
                  {{-- Role --}}
                  <div class="form-group col-md-3">
                    <label for="role">Vai trò:</label>
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
                <a class="btn btn-default mr-1" href="{{ route('user.index') }}">Quay lại</a>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('limit_stationery.components.modal_limit')
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
    $(function() {
      $('.select2').select2()

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

      var positions = @json($positions);
      const ID_POSITION_USER = `{{ optional($user->position)->id }}`;
      var departmentSelect =  $('[name="id_department"]');
      var postionSelect =  $('[name="id_position"]');
      renderPosition(departmentSelect.find(':selected').data('room'));
      
      postionSelect.find(`option[value="${ID_POSITION_USER}"]`).prop('selected', 'selected')
      departmentSelect.change(function() {
        renderPosition($(this).find(':selected').data('room'));
      });
      
      function renderPosition(is_room) {
        let array_position = positions.filter(function (item) {
          return item.is_room === is_room;
        })
        let htmls = array_position.map(function(item) {
          return `<option value='${item.id}'>${item.name}</option>`
        })
        let option_default = `<option value>Khác</option>`;
        postionSelect.html(htmls.join('') + option_default);
      }
    })
  </script>
@endsection
