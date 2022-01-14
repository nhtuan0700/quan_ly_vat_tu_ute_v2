@component('mail::message')
  Hệ thống có yêu cầu cập nhật hạn mức mới<br />
  Vui lòng vào hệ thống xử lý yêu cầu này!<br />
  Xem [tại đây]({{ $url }})

  Cảm ơn,<br>
  {{ config('app.name') }}
@endcomponent
