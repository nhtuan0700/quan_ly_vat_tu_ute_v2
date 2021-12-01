@extends('forgot_password.layout')
@section('content')
  <p class="login-box-msg">Xác nhận email</p>
  <p>Vui lòng kiểm tra email của bạn<br><span class="text-primary">{{ session()->get('email') }}</span></p>
  <p>Vui lòng nhập mã xác nhận email của bạn</p>
  <form action="{{ route('forgot_password.submit_code') }}" method="post">
    @csrf
    <div class="input-group mb-3">
      <input type="hidden" name="email" value="{{ session()->get('email') }}">
      <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Mã xác nhận" name="code">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>

      @error('code')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">XÁC NHẬN</button>
      </div>
    </div>
    <div id="timeout">
      <p>Bạn chưa nhận được email? <span></span></p>
    </div>
  </form>
  <div class="box-spinner d-none">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
@endsection
@section('script')
  <script src="{{ asset('js/ajax.js') }}"></script>
  <script>
    $(function() {
      var seconds = 60;
      countdown(seconds);

      const email = `{{ session()->get('email') }}`;
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': `{{ csrf_token() }}`
        }
      });

      function countdown(seconds) {
        let idInterval = setInterval(() => {
          $('#timeout span').text(`${seconds}s`)
          if (seconds-- === 0) {
            let link = '<a href="#">Gửi lại mã</a>'
            $('#timeout span').html(link)
            $('#timeout span a').click(function(e) {
              e.preventDefault();
              sendCode();
            })
            clearInterval(idInterval)
          }
        }, 1000);
      }

      function sendCode() {
        const url = `{{ route('forgot_password.send_code') }}`;
        data = {
          'email': email
        }
        ajax(url, data, "POST", function(result) {
          if (!result.error) {
            toastr.success('Yêu cầu gửi lại mã thành công')
            countdown(seconds)
            $('#timeout span a').remove()
          } else {
            toastr.error('Yêu cầu gửi lại mã thất bại')
          }
        }, function() {
          toastr.error('Yêu cầu gửi lại mã thất bại')
        })
      }
    })
  </script>
@endsection
