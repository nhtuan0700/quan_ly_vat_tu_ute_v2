<button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#modal">Chọn thiết bị</button>
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">
          Chọn thiết bị
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="float-right mb-3 d-flex align-items-center">
          <form action="" id="search" onsubmit="event.preventDefault()">
            <input class="form-control w-75 d-inline-block" id="id_thietbi" form="search"
              placeholder="Mã thiết bị ...">
            <button type="button" class="btn btn-info ml-1" id="btn-search">Tìm</button>
          </form>
        </div>
        
        <table class="table" id="table-modal">
          <thead>
            <tr>
              <th>Mã thiết bị</th>
              <th>Tên thiết bị</th>
              <th>Phòng</th>
              <th>Ngày cấp</th>
              <th>Trạng thái</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('js')
<script src="{{ asset('js/ajax.js') }}"></script>
<script>
  $(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#btn-search').click(function () {
      let url = `{{ route('thietbi.list_ajax') }}`;
      let id_exists = [];
      $('table#table-thietbi tbody tr').each(function(item) {
        id_exists.push($(this).data('id'))
      });
      let data =  {
        id: $('input#id_thietbi').val(),
        id_exists: id_exists
      };
      ajax(url, data, "get", function(response) {
        console.log(response)
        let rowHTML = response.map(function(item) {
          return `<tr>
                    <td class="id">${item.id}</td>
                    <td class="name">${item.name}</td>
                    <td class="phong">${item.phong}</td>
                    <td class="ngay_cap">${item.ngay_cap || ''}</td>
                    <td class="status">${item.statusText}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-add btn-sm"  
                        data-id="${item.id}" onclick="addItem(this)">
                        Chọn
                      </button>  
                    </td>
                  </tr>`
        }).join('')
        rowHTML = rowHTML || `<span class="text-danger">Không tìm thấy thiết bị</span>`
        $('#table-modal tbody').html(rowHTML || 'Không tìm thấy thiết bị')
      })
    })
  })

  function addItem(elm) {
    let parent = $(elm).closest('tr');
    let obj = {
      id: parent.find('td.id').text(),
      name: parent.find('td.name').text(),
      phong: parent.find('td.phong').text(),
      statusText: parent.find('td.status').text()
    }
    let rowHTML = `<tr data-id="${obj.id}">
                    <th class="id">${obj.id}</th>
                    <td class="name">${obj.name}</td>
                    <td class="phong">${obj.phong}</td>
                    <td class="phong">${obj.statusText}</td>
                    <td>
                      <input class="form-control" name="thietbi[${obj.id}]" value="" />
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-remove btn-sm"  
                        data-id="${obj.id}" onclick="removeItem(this)">
                        Xóa
                      </button>  
                    </td>
                  </tr>`;

    $('table#table-thietbi tbody').append(rowHTML);
    $('input#id_thietbi').val('');
    $('#table-modal tbody').html('');
    $('#modal').modal('hide');
  }

  function removeItem(elm) {
    $(elm).closest('tr').remove();
  }
</script>
@endpush