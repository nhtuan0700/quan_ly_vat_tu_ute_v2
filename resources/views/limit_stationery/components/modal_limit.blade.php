<div class="modal fade" id="modalLimit" tabindex="0" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hạn mức văn phòng phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('limit.update', ['id_user' => $user->id]) }}" method="post" id="form-limit"
        enctype="multipart/form-data">
        <div class="modal-body">
          <input class="form-control float-right w-25 mb-3" id="key-search" placeholder="Tên văn phòng phẩm ...">
            @csrf
            <div class="card-body table-responsive p-0" style="height: 400px;">
              <table class="table table-head-fixed text-nowrap" id="limit">
                <thead>
                  <th scope="col">Mã</th>
                  <th scope="col">Tên</th>
                  <th scope="col">Đơn vị tính</th>
                  <th scope="col" width="20%" class="text-center">Đã sử dụng</th>
                  <th scope="col" width="20%">Tối đa</th>
                  @if($limit_updating)
                    <th scope="col" class="text-center">Đang yêu cầu cập nhật</th>
                  @endif
                </thead>
                <tbody>
                  @php
                    $index = 1;
                  @endphp
                  @foreach ($limit_stationeries as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->unit }}</td>
                      <td class="text-center">{{ $item->qty_used ?? 0 }}</td>
                      <td>
                        <div class="form-group">
                          <input class="form-control" type="number" name="limits[{{ $item->id }}]"
                            value="{{ $item->qty_max ?? 0 }}" rules="integer|min:0">
                        </div>
                      </td>
                      @if($limit_updating)
                        <td class="text-center">{{ $item->qty_update }}</td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <div class="modal-footer justify-content-start">
          <div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" id="file" name="files[]" multiple accept="image/*" rules="required">
                <label class="custom-file-label" for="file">Choose file</label>
              </div>
              <div id="preview-image2" class="preview-image preview-product d-flex flex-wrap zoom-image">
  
              </div>
            </div>
            <button type="submit" class="btn btn-primary" 
              @if ($limit_updating) disabled @endif>Cập nhật</button>
          </div>
        </div>
      </form>

    </div>
  </div>

</div>

<div class="modal fade modal-second" id="modalZoomImage" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Minh chứng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" alt="" class="img w-100">
      </div>
  </div>
</div>
@push('js')
  <script src="{{ asset('js/nonAccentVietnamese.js') }}"></script>
  <script src="{{ asset('js/preview-image.js') }}"></script>
  <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('js/zoom-image.js') }}"></script>
  <script>
    $(function() {
      const validatorLimit = new Validator('#form-limit');  

      imagePreview('#file');
      const zoomImage = new ZoomImage('.zoom-image', '#modalZoomImage')
      bsCustomFileInput.init();
      $("#key-search").on("keyup", function() {
        var value = $(this).val()
        filterTable(value)
      });
    })

    function filterTable(value) {
      $("#limit tbody tr").filter(function() {
        $(this).toggle(nonAccentVietnamese($(this).text()).indexOf(nonAccentVietnamese(value)) > -1)
      });
    }
  </script>
@endpush
