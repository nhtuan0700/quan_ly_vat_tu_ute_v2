<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">
          Thiết bị
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="float-right mb-3 d-flex align-items-center">
          <form action="" id="search" onsubmit="event.preventDefault()">
            <div class="d-flex">
              <input class="form-control mr-1" id="id" form="search"
                placeholder="Mã thiết bị ...">
              <input class="form-control" id="name" form="search"
                placeholder="Tên thiết bị ...">
              <button type="button" class="btn btn-info ml-1" id="btn-search">Tìm</button>
            </div>
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
              <th class="fit"></th>
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
  <script src="{{ asset('js/validator.js') }}"></script>
  <script>
    $(function() {
      const validator = new Validator('#form-note');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#btn-search').click(function() {
        let url = `{{ route('equipment.list_ajax') }}`;
        let id_exists = [];
        $('table#table-equipment tbody tr').each(function(item) {
          id_exists.push($(this).data('id'))
        });
        let data = {
          id: $('input#id').val(),
          name: $('input#name').val(),
          id_exists: id_exists
        };
        ajax(url, data, "get", function(response) {
          let rowHTML = response.map(function(item) {
            let disabled = '';
            if (item.status != 1 || item.date_grant == null) {
              disabled = 'disabled'
            }
            return `<tr>
                    <td class="id">${item.id}</td>
                    <td class="name">${item.name}</td>
                    <td class="room">${item.room || ''}</td>
                    <td class="date_grant">${item.date_grant || ''}</td>
                    <td class="status">${item.statusText}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-add"  
                        data-id="${item.id}" onclick="addItem(this)" ${disabled}>
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
        room: parent.find('td.room').text(),
        statusText: parent.find('td.status').text()
      }
      let rowHTML = `<tr data-id="${obj.id}">
                    <th class="id">${obj.id}</th>
                    <td class="name">${obj.name}</td>
                    <td class="room">${obj.room}</td>
                    <td class="status">${obj.statusText}</td>
                    <td>
                      <div class="form-group">
                        <input class="form-control" name="equipments[${obj.id}]" rules="required"/>
                      </div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-remove"  
                        data-id="${obj.id}" onclick="removeItem(this)">
                        Xóa
                      </button>  
                    </td>
                  </tr>`;

      $('table#table-equipment tbody').append(rowHTML);
      $('input#id_equipment').val('');
      $('#table-modal tbody').html('');
      $('#modal').modal('hide');
      const validator = new Validator('#form-note');

      $('#form-note').find('[type="submit"]').removeAttr('disabled')
    }

    function removeItem(elm) {
      $(elm).closest('tr').remove();
      const validator = new Validator('#form-note');
    }
  </script>
@endpush
