@extends('master')
@section('title')
  Đăng ký văn phòng phẩm
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div>
                <p><b>Người đăng ký: </b>{{ auth()->user()->name }}</p>
              </div>
              <div class="row">
                <p class="col-3"><b>Đợt đăng ký: </b>{{ $period->id }}</p>
                <p><b>Thời gian: </b>{{ $period->start_time . ' - ' . $period->end_time }}</p>
              </div>
              <div>
                <p><b>Thời gian hạn mức áp dụng </b>
                  @php
                    $month = \Carbon\Carbon::parse($period->getRawOriginal('start_time'))->month;                          
                    $year = \Carbon\Carbon::parse($period->getRawOriginal('start_time'))->year;                          
                  @endphp
                  (Quý {{ quarter_of_year($month) }}: {{ range_time_in_quarter($month, $year) }})
                </p>
              </div>
            </div>

            <div class="card-body">
              <div>
                <h5>Danh sách đăng ký văn phòng phẩm</h5>
                <form action="{{ route('registration.save') }}" method="POST">
                  @csrf
                  <table class="table" id="list-registration">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Đơn vị tính</th>
                        <th class="text-center">Số lượng đăng ký</th>
                        <th class="text-center">Số lượng còn lại cho phép</th>
                        <th class="fit"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($registrations as $item)
                        <tr class="bg-light">
                          <th class="id">{{ $item->id }}</th>
                          <td class="name">{{ $item->name }}</td>
                          <td class="unit">{{ $item->unit }}</td>
                          <td class="text-center qty">
                            <div class="form-group w-25 m-auto">
                              <input class="form-control text-center" name="stationeries[{{ $item->id }}]"
                                type="number" value="{{ intval($item->qty) }}" 
                                rules="integer|min:1|max:{{ $item->qty_remain + $item->qty }}" />
                            </div>
                          </td>
                          <td class="text-center qty_max">{{ intval($item->qty_remain) }}</td>
                          <td><a class="btn btn-danger btn-remove" data-id="{{ $item->id }}"
                              onclick="remove(event, this)">Xóa</a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <button class="btn btn-primary" id="btn-save">Lưu</button>
                </form>
              </div>
              <br>
              <hr>
              <div>
                <h5>Danh sách văn phòng phẩm</h5>
                <input class="form-control float-right w-25 mb-3" id="key-search" placeholder="Tên văn phòng phẩm ...">
                <table class="table" id="list-stationery">
                  <thead>
                    <tr>
                      <th>Mã</th>
                      <th>Tên</th>
                      <th>Đơn vị tính</th>
                      <th class="text-center">Số lượng đã đăng ký</th>
                      <th class="text-center">Hạn mức tối đa</th>
                      <th class="fit"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($limits as $item)
                      @php
                        $item_regis = $registrations->where('id', $item->id)->first();
                      @endphp
                      @if (!!$item_regis)
                        <tr id="stationery-{{ $item->id }}" class="d-none">
                          <td class="id">{{ $item->id }}</td>
                          <td class="name">{{ $item->name }}</td>
                          <td class="unit">{{ $item->unit }}</td>
                          <td class="text-center qty_used" data-qty="{{ intval($item_regis->qty) }}">
                            {{ intval($item->qty_used) }}
                          </td>
                          <td class="text-center qty_max">{{ intval($item->qty_max) }}</td>
                          <td>
                            <button type="button" class="btn btn-info btn-add">Thêm</button>
                          </td>
                        </tr>
                      @else
                        <tr id="stationery-{{ $item->id }}">
                          <td class="id">{{ $item->id }}</td>
                          <td class="name">{{ $item->name }}</td>
                          <td class="unit">{{ $item->unit }}</td>
                          <td class="text-center qty_used">{{ intval($item->qty_used) }}</td>
                          <td class="text-center qty_max">{{ intval($item->qty_max) }}</td>
                          <td>
                            <button class="btn btn-info btn-add" 
                              @if (intval($item->qty_used) === intval($item->qty_max)) disabled @endif>
                              Thêm
                            </button>
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@section('script')
  <script src="{{ asset('js/nonAccentVietnamese.js') }}"></script>
  <script src="{{ asset('js/validator.js') }}"></script>
  <script>
    $(function() {
      const validator = new Validator('form');
      $("#key-search").on("keyup", function() {
        var value = $(this).val()
        filterTable(value)
      });

      if ($('table#list-registration tbody tr').length == 0) {
        $('button#btn-save').attr('disabled', 'disabled')
      }

      $(".btn-add").click(function(e) {
        let parent = $(this).parent();
        let data = {
          id: parent.siblings('.id').text(),
          name: parent.siblings('.name').text(),
          unit: parent.siblings('.unit').text(),
          qty: parseInt(parent.siblings('.qty_used').data('qty')),
          qty_used: parseInt(parent.siblings('.qty_used').text()),
          qty_max: parseInt(parent.siblings('.qty_max').text()),
        }
        let row = `<tr class="${data.qty ? 'bg-light' : ''}">
                    <th class="id">${data.id}</th>
                    <td class="name">${data.name}</td>
                    <td class="unit">${data.unit}</td>
                    <td class="text-center qty">
                      <div class="form-group w-25 m-auto">
                        <input class="form-control text-center" name="stationeries[${data.id}]"
                          type="number" value="${data.qty || 1}" rules="integer|min:1|max:${data.qty_max - data.qty_used}"/>
                      </div>
                    </td>
                    <td class="text-center qty_max">${data.qty_max - data.qty_used}</td>
                    <td><a class="btn btn-danger btn-remove" data-id="${data.id}" onclick="remove(event, this)">Xóa</a></td>
                  </tr>`;

        $('#list-registration tbody').append(row)
        $('button#btn-save').removeAttr('disabled')
        parent.parent().addClass('d-none')
        const validator = new Validator('form');

        $('.btn-remove').click(function(e) {
          remove(e, $(this))
        })
      })
    })

    function remove(e, elm) {
      e.preventDefault()
      let id = $(elm).data('id')
      $(elm).closest('tr').remove()
      $('#list-stationery tbody').find(`tr#stationery-${id}`).removeClass('d-none')
      const validator = new Validator('form');
    }

    function filterTable(value) {
      $("#list-stationery tbody tr").filter(function() {
        $(this).toggle(nonAccentVietnamese($(this).text()).indexOf(nonAccentVietnamese(value)) > -1)
      });
    }
  </script>
@endsection
