@switch($item->status)
  @case(1)
    <span>Bình thường</span>
    @break
  @case(2)
    <span>Đang sửa</span>
    @break
  @default
    <span>Đã hỏng</span>
@endswitch