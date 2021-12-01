
<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalImportLabel">Import danh sách người dùng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <span class="text-warning mb-0 mr-1">Chú ý</span>
          <a href="{{ route('user.download_template') }}" class="btn btn-light btn-sm">Tải file mẫu</a>
          <ul>
            <li>Mã không được trùng</li>
            <li>Email không được trùng</li>
            <li>CMND không được trùng</li>
            <li>Mã vai trò phải có trong cơ sở dữ liệu</li>
            <li>Mã khoa phải có trong cơ sở dữ liệu</li>
          </ul>
        </div>
        <form action="{{ route('user.import') }}" method="post" id="import_excel" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="file">File excel</label>
            <input type="file" class="form-control-file" id="file" name="file_excel" accept=".xlsx">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="import_excel">Import</button>
      </div>
    </div>
  </div>
</div>
@push('js')
@php
if (session('alert-result'))
  {
    echo '<script>alert("'.session('alert-result').'")</script>';
  }
@endphp
@endpush