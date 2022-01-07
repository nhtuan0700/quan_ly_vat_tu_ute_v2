@extends('master')
@section('title')
  Quản lý hạn mức mặc định
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div>
            <p class="card-title mr-3">Hạn mức mặc định</p>
          </div>
        </div>
        <div class="card-body">
          <div class="form-row">
            <div class="col-md-3">
              <label for="">Đơn vị</label>
              <select name="id_department" id="" class="form-control">
                @foreach ($departments as $item)
                  <option value="{{ $item->id }}" data-room="{{ $item->is_room }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="">Chức vụ</label>
              <select name="id_position" id="" class="form-control">
                @foreach ($positions as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-primary" id="btn-update">Cập nhật</button>
              <input class="form-control float-right w-25 mb-3" id="key-search" placeholder="Tên văn phòng phẩm ...">
            </div>
            <table class="table table-hover text-nowrap">
              <thead>
                <th scope="col">Mã</th>
                <th scope="col">Tên</th>
                <th scope="col">Đơn vị tính</th>
                <th scope="col" class="text-center" width="10%">Hạn mức</th>
                <th></th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <button class="btn btn-outline-secondary" id="btn-up">
    <i class="fas fa-arrow-up"></i>
  </button>
@endsection

@section('script')
  <script src="{{ asset('js/nonAccentVietnamese.js') }}"></script>
  <script src="{{ asset('js/ajax.js') }}"></script>
  <script>
    $(function() {
      const URL_LIST = `{{ route('limit_default.list_stationery') }}`;
      const URL_UPDATE = `{{ route('limit_default.update') }}`;
      var departmentSelect = $('[name="id_department"]');
      var positionSelect = $('[name="id_position"]');
      var positions = @json($positions);
      
      renderPosition(departmentSelect.find(':selected').data('room'));
      getData(URL_LIST);
      handleEvent();

      function renderPosition(is_room) {
        let array_position = positions.filter(function (item) {
          return item.is_room === is_room;
        })
        let htmls = array_position.map(function(item) {
          return `<option value='${item.id}'>${item.name}</option>`
        })
        positionSelect.html(htmls.join(''));
      }

      function handleEvent() {
        departmentSelect.change(function() {
          renderPosition($(this).find(':selected').data('room'));
          getData(URL_LIST);
        });

        positionSelect.change(function() {
          getData(URL_LIST);
        });

        $('#btn-up').click(function() {
          window.scrollTo({
            top: 140,
            behavior: 'smooth'
          })
        })

        $("#key-search").on("keyup", function() {
          var value = $(this).val()
          filterTable(value)
        });

        $('#btn-update').click(function () {
          updateData(URL_UPDATE, URL_LIST);
        })
      }

      function getData(url) {
        var id_department = departmentSelect.val();
        var id_position = positionSelect.val();
        var data = {
          id_department: id_department,
          id_position: id_position,
        }
        ajax(url, data, 'get', function(response) {
          rederStationery(response)
        }, function() {

        })

      }

      function updateData(url_update, url_list) {
        var id_department = departmentSelect.val();
        var id_position = positionSelect.val();
        const stationeries = Array.from($('table tbody tr')).map(function (item) {
          let stationery = {
            id: item.querySelector('.id').innerText,
            qty: item.querySelector('.qty').value,
          }
          return stationery;
        });
        var data = {
          id_department: id_department,
          id_position: id_position,
          stationeries: stationeries
        }
        ajax(url_update, data, 'put', function(response) {
          toastr.success('Cập nhật thành công!');
          console.log(response)
          getData(url_list);
        }, function(error) {
          toastr.error('Cập nhật thất bại!');
          getData(url_list);
        })
      }

      function rederStationery(stationeries) {
        var htmls = stationeries.map(function(item) {
          return `<tr class="${item.qty > 0 ? 'bg-light' : ''}">
              <td class="id">${item.id}</td>
              <td class="name">${item.name}</td>
              <td>${item.unit}</td>
              <td>
                <input type="number" value="${item.qty || 0}" class="form-control qty"/> 
              </td>
              <td></td>
            </tr>`
        })
        $('table tbody').html(htmls.join(''));
      }

      function filterTable(value) {
        $("table tbody tr").filter(function() {
          $(this).toggle(nonAccentVietnamese($(this).text()).indexOf(nonAccentVietnamese(value)) > -1)
        });
      }
    })
  </script>
@endsection
