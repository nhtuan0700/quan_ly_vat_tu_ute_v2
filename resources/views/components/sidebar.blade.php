<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">

  <!-- Sidebar -->
  <div class="sidebar mt-0">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 pt-3 mb-3">
      <div class="image d-block">
        <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        {{-- <a href="#" class="d-block">{{ Auth::user()->role->name }}</a> --}}
        <h5 class="text-light m-0">{{ auth()->user()->name }}</h5>
        <p class="text-light m-0">{{ auth()->user()->role->name }}</p>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('index') }}" class="nav-link" id="link-home">
            <p>
              Trang chủ
            </p>
          </a>
        </li>

        @can('user-manage')
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link" id="link-user">
              <p>
                Quản lý người dùng
              </p>
            </a>
          </li>
        @endcan

        @can('supplies-manage')
          <li class="nav-item">
            <a href="#" class="nav-link" id="link-vat-tu">
              <p>
                Quản lý vật tư
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('stationery.index') }}" class="nav-link" id="link-van-phong-pham">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Văn phòng phẩm
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('equipment.index') }}" class="nav-link" id="link-thiet-bi">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Thiết bị
                  </p>
                </a>
              </li>
            </ul>
          </li>
        @endcan

        @can('period-manage')
          <li class="nav-item">
            <a href="{{ route('period.index') }}" class="nav-link" id="link-dot-dang-ky">
              <p>
                Quản lý đợt đăng ký mua văn phòng phẩm
              </p>
            </a>
          </li>
        @endcan

        @can('request_note-process')
          <li class="nav-item">
            <a href="{{ route('process_note.index') }}" class="nav-link" id="link-phieu-de-nghi">
              <p>
                Danh sách phiếu đề nghị
                <span class="text-white">
                  <sup class="text-md" id="count_rq_note_processing">{{ count_note_processing() }}</sup>
                </span>
              </p>
            </a>
          </li>
        @endcan

        @can('handover_note-manage')
          <li class="nav-item">
            <a href="{{ route('handover_note.index') }}" class="nav-link" id="link-phieu-ban-giao">
              <p>
                Quản lý phiếu bàn giao
              </p>
            </a>
          </li>
        @endcan

        <li class="nav-item">
          <a href="{{ route('limit.index') }}" class="nav-link" id="link-han-muc">
            <p>
              Hạn mức đăng ký văn phòng phẩm của tôi
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('registration.index') }}" class="nav-link" id="link-dang-ky-van-phong-pham">
            <p>
              Đăng ký văn phòng phẩm
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('history.index') }}" class="nav-link" id="link-lich-su-dang-ky">
            <p>
              Lịch sử đăng ký văn phòng phẩm của tôi
            </p>
          </a>
        </li>

        @can('registration-handover')
          <li class="nav-item">
            <a href="{{ route('handover_registration.list_period') }}" class="nav-link"
              id="link-ban-giao-dang-ky">
              <p>
                Bàn giao đăng ký văn phòng phẩm của đơn vị
              </p>
            </a>
          </li>
        @endcan

        @can('buy_note-manage')
          <li class="nav-item">
            <a href="{{ route('buy_note.index') }}" class="nav-link" id="link-phieu-mua">
              <p>
                Quản lý phiếu mua của đơn vị
              </p>
            </a>
          </li>
        @endcan

        <li class="nav-item">
          <a href="{{ route('fix_note.index') }}" class="nav-link" id="link-phieu-sua">
            <p>
              Quản lý phiếu sửa của tôi
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

@push('js')
  <script>
    $(function() {
      @if (auth()->user()->can('request_note-process'))
        const channel = 'request-note';
        window.Echo.private(channel).listen('.RequestNote', (data) => {
          console.log(data)
          $('#count_rq_note_processing').text(data.count);
          if (data.is_create) {
            $(document).Toasts('create', {
              title: 'Thông báo',
              position: 'bottomLeft',
              body: 'Có phiếu đề nghị mới cần được xử lý',
              delay: 5000,
              autohide: true,
            })
          }
        });
      @endif
    })
  </script>
@endpush
