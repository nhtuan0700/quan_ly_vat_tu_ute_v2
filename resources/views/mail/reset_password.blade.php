@component('mail::message')
# Mã xác nhận ở đây
Bạn có thể nhập mã này để tìm lại mật khẩu: {{ $code }}

Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent