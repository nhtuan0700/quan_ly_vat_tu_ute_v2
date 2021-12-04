<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>In phiếu bàn giao</title>

  <style>
    body {
      font-family: "DejaVu Serif";
      font-size: 12px;
      font-weight: 600px;
      padding: 0;
    }

    .text-center {
      text-align: center !important;
    }

    .text-border {
      border-bottom: 1px solid black;
      padding-bottom: 3px;
      display: inline-block
    }

    .w-100 {
      width: 100% !important;
    }

    .table {
      border-collapse: collapse;
      width: 100%;
      font-size: 11px;
    }

    .table td,
    .table th {
      text-align: left;
      border: 1px solid #dddddd;
      padding: 5px;
    }

    .table th {
      text-align: center;
    }
    .clear-both {
      clear: both
    }
  </style>
</head>

<body>
  <div style="float: left;text-align:center">
    <b>ĐẠI HỌC ĐÃ NẴNG</b><br>
    <b class="text-border">
      ĐẠI HỌC SƯ PHẠM KỸ THUẬT</b>
    </p>
  </div>
  <div style="float: right;text-align:center">
    <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br>
    <b class="text-border">
      Độc lập - Tự do - Hạnh phúc</b></p>
  </div>
  <div class="clear-both"></div>
  <h3 class="text-center">PHIẾU BÀN GIAO</h3>

  <div>
    <table class="w-100">
      <tr>
        <td>
          <b>Mã phiếu bàn giao:</b> {{ $note->id }}
        </td>
        <td>
          <b>Mã phiếu đề nghị:</b> {{ $note->request_note->id }}
        </td>
      </tr>
      <tr>
        <td>
          <b>Người tạo phiếu bàn giao:</b> {{ $note->creator->name }}
        </td>
        <td>
          <b>Người tạo phiếu đề nghị:</b> {{ $note->request_note->creator->name }}
        </td>
      </tr>
      <tr>
        <td>
          <b>Ngày tạo phiếu bàn giao:</b> {{ $note->created_at }}
        </td>
      </tr>
    </table>
  </div>
  @if ($note->request_note->is_buy)
    <p>Danh sách bàn giao văn phòng phẩm</p>
    <table class="table">
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên văn phòng phẩm</th>
          <th>Đơn vị tính</th>
          {{-- <th>Giá</th> --}}
          <th class="text-center">Số lượng yêu cầu</th>
          <th class="text-center">Số lượng bàn giao</th>
        </tr>
      </thead>
      <tbody>
        @php
          $i = 1;
        @endphp
        @foreach ($note->detail_handover_buy2() as $item)
          <tr>
            <th>{{ $i++ }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->unit }}</td>
            <td class="text-center">{{ $item->qty }}</td>
            <td class="text-center">{{ $item->qty_handovering }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>Danh sách bàn giao thiết bị</p>
    <table class="table">
      <thead>
        <tr>
          <th>Mã thiết bị</th>
          <th>Tên thiết bị</th>
          <th>Phòng</th>
          <th>Lý do sửa</th>
          <th>Chi phí sửa</th>
          <th>Tình trạng sửa</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($note->detail_handover_fix2() as $item)
          <tr>
            <th>{{ $item->id_equipment }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->room }}</td>
            <td>{{ $item->reason }}</td>
            <td>{{ format_currency($item->cost) }}</td>
            <td>
              @if ($item->is_fixable === 1)
                Sửa được
              @else
                Không sửa được
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
  <div style="margin-top: 30px"></div>
  <div style="float:right;">
    <span>Đà nẵng ngày {{ now()->day }} tháng {{ now()->month }} năm {{ now()->year }}</span>
  </div>
  <div class="clear-both"></div>
  <table class="w-100">
    <tr>
      <td style="padding-left: 90px">
        <b>Người tạo phiếu</b>
      </td>
      <td style="text-align: right; padding-right: 90px">
        <b>Người nhận</b>
      </td>
    </tr>
    <tr>

    </tr>
  </table>
</body>

</html>
