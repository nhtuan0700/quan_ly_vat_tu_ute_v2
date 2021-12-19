<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>In phiếu đề nghị</title>

  <style>
    body {
      font-family: "roboto";
      font-size: 12px;
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

    td.fit,
    th.fit {
      white-space: nowrap;
      width: 1%;
    }

  </style>
</head>

<body>
  <div style="float: left;text-align:center">
    <b>ĐẠI HỌC ĐÀ NẴNG</b><br>
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
  <h3 class="text-center">PHIẾU ĐỀ NGHỊ MUA</h3>

  <div>
    <table class="w-100">
      <tr>
        <td>
          <b>Mã phiếu đề nghị:</b> {{ $note->id }}
        </td>
        <td>
          <b>Trạng thái phiếu:</b> {!! $note->statusHTML !!}
        </td>
      </tr>
      <tr>
        <td>
          <b>Người tạo phiếu:</b> {{ $note->creator->name }}
        </td>
        <td>
          <b>Đơn vị:</b> {{ $note->department->name }}
        </td>
      </tr>
      <tr>
        <td>
          <b>Ngày tạo phiếu:</b> {{ $note->created_at }}
        </td>
      </tr>
    </table>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên văn phòng phẩm</th>
        <th class="text-center">Đơn vị tính</th>
        <th class="text-center">Số lượng yêu cầu</th>
      </tr>
    </thead>
    <tbody>
      @php($i = 1)
      @foreach ($note->detail_buy as $item)
        <tr>
          <th>{{ $i++ }}</th>
          <td>{{ $item->stationery->name }}</td>
          <td class="text-center">{{ $item->stationery->unit }}</td>
          <td class="text-center">{{ $item->qty }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div style="margin-top: 30px"></div>
  <table class="w-100">
    <tr>
      <td class="fit"></td>
      <td></td>
      <td class="fit">
        <span>Đà nẵng ngày {{ now()->day }} tháng {{ now()->month }} năm {{ now()->year }}</span>
      </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="text-align: center">
        <b>Nhân viên cơ sở vật chất</b>
      </td>
    </tr>
  </table>
</body>

</html>
