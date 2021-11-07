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
              <p class="col-3"><b>Đợt đăng ký: </b>{{ $dot_dk->id }}</p>
              <p><b>Thời gian: </b>{{ $dot_dk->start_at . " - " . $dot_dk->end_at }}</p>
            </div>
          </div>

          <div class="card-body">
            <div>
              <h5>Danh sách đăng ký văn phòng phẩm</h5>
              <form action="{{ route('dangky_vpp.save') }}" lang="vi" method="POST">
                @csrf
                <table class="table" id="list-dk">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tên</th>
                      <th>Đơn vị tính</th>
                      <th width="20%" class="text-center">Số lượng đăng ký</th>
                      <th width="20%" class="text-center">Số lượng còn lại cho phép</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($list_dangky as $item)
                      <tr class="bg-light">
                        <th class="id">{{ $item->id }}</th>
                        <td class="name">{{ $item->name }}</td>
                        <td class="dvt">{{ $item->dvt }}</td>
                        <td class="text-center qty">
                        <input class="form-control w-25 text-center m-auto" name="vanphongpham[{{ $item->id }}]"
                          type="number" value="{{ $item->qty }}" min="1" step="1"/>
                        </td>
                        <td class="text-center qty_max">{{ $item->qty_remain }}</td>
                        <td><a class="btn btn-danger btn-remove" data-id="{{ $item->id }}" onclick="remove(event, this)">Xóa</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
  
                <button class="btn btn-primary">Lưu</button>  
              </form>
            </div>
            <br>  
            <hr>
            <div>
              <h5>Danh sách văn phòng phẩm</h5>
              <input class="form-control float-right w-25 mb-3" id="key-search" placeholder="Tên văn phòng phẩm ...">
              <table class="table" id="list-vpp">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Đơn vị tính</th>
                    <th class="text-center">Số lượng đã đăng ký</th>
                    <th class="text-center">Hạn mức tối đa</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($list_hanmuc as $item)
                    @php
                      $item_dk = $list_dangky->where('id', $item->id)->first()
                    @endphp
                    @if (!!$item_dk)
                      <tr id="vpp-{{ $item->id }}" class="d-none">
                        <td class="id">{{ $item->id }}</td>
                        <td class="name">{{ $item->name }}</td>
                        <td class="dvt">{{ $item->dvt }}</td>
                        <td class="text-center qty_used" data-qty="{{ $item_dk->qty }}">{{ $item->qty_used }}</td>
                        <td class="text-center qty_max">{{ $item->qty_max }}</td>
                        <td>
                          <a href="#" class="btn btn-info btn-add">Thêm</a>
                        </td>
                      </tr>
                    @else
                      <tr id="vpp-{{ $item->id }}">
                        <td class="id">{{ $item->id }}</td>
                        <td class="name">{{ $item->name }}</td>
                        <td class="dvt">{{ $item->dvt }}</td>
                        <td class="text-center qty_used">{{ $item->qty_used }}</td>
                        <td class="text-center qty_max">{{ $item->qty_max }}</td>
                        <td>
                          <a href="#" class="btn btn-info btn-add">Thêm</a>
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
<script>
  $(function() {
    $("#key-search").on("keyup", function() {
      var value = $(this).val()
      filterTable(value)
    });    

    $(".btn-add").click(function(e) {
      e.preventDefault();
      let parent = $(this).parent();
      let data = {
        id: parent.siblings('.id').text(),
        name: parent.siblings('.name').text(),
        dvt: parent.siblings('.dvt').text(),
        qty: parseInt(parent.siblings('.qty_used').data('qty')),
        qty_used: parseInt(parent.siblings('.qty_used').text()),
        qty_max: parseInt(parent.siblings('.qty_max').text()),
      }
      let row = `<tr class="${data.qty ? 'bg-light' : ''}">
                  <td class="id">${data.id}</td>
                  <td class="name">${data.name}</td>
                  <td class="dvt">${data.dvt}</td>
                  <td class="text-center qty">
                  <input class="form-control w-25 text-center m-auto" name="vanphongpham[${data.id}]"
                    type="number" value="${data.qty || 1}" min="1" step="1"/>
                  </td>
                  <td class="text-center qty_max">${data.qty_max - data.qty_used}</td>
                  <td><a class="btn btn-danger btn-remove" data-id="${data.id}" onclick="remove(event, this)">Xóa</a></td>
                </tr>`

      $('#list-dk tbody').append(row)
      parent.parent().addClass('d-none')

      $('.btn-remove').click(function(e) {
        remove(e, $(this))
      })
    })
  })

  function remove(e, elm) {
    e.preventDefault()
    let id = $(elm).data('id')
    $(elm).closest('tr').remove()
    $('#list-vpp tbody').find(`tr#vpp-${id}`).removeClass('d-none')
  }

  function filterTable(value) {
    value = value.toLowerCase()
    $("#list-vpp tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  }
</script>
@endsection