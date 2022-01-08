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
        <h5 class="text-light mt-1">{{ auth()->user()->name }}</h5>
        <div class="text-light mt-1"><b>Đơn vị:</b> {{ auth()->user()->department->name }}</div>
        <div class="text-light mt-1"><b>Chức vụ:</b> {{ auth()->user()->position->name }}</div>
        <div class="text-light mt-1"><b>Vai trò: </b>{{ auth()->user()->role->name }}</div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column list-menu" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('index') }}" class="nav-link" data-link="home">
            <p>
              Trang chủ
            </p>
          </a>
        </li>

        @can('user-manage')
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link" data-link="user">
              <p>
                Quản lý người dùng
              </p>
            </a>
          </li>
        @endcan

        @can('process-limit')
          <li class="nav-item">
            <a href="{{ route('process_limit.index') }}" class="nav-link" data-link="limit_process">
              <p>
                Xử lý yêu cầu cập nhật hạn mức
                <span class="text-white">
                  <sup class="text-md" id="count_rq_note_processing">{{ count_limit_processing() }}</sup>
                </span>
              </p>
            </a>
          </li>
        @endcan

        @can('limit-manage')
          <li class="nav-item">
            <a href="{{ route('limit_default.index') }}" class="nav-link" data-link="limit_default">
              <p>
                Quản lý hạn mức mặc định
              </p>
            </a>
          </li>
        @endcan

        @can('supplies-manage')
          <li class="nav-item menu-parent">
            <a href="#" class="nav-link" data-link="suplies">
              <p>
                Quản lý vật tư
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('stationery.index') }}" class="nav-link" data-link="stationery">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Văn phòng phẩm
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('equipment.index') }}" class="nav-link" data-link="equipment">
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
            <a href="{{ route('period.index') }}" class="nav-link" data-link="period">
              <p>
                Quản lý đợt đăng ký mua văn phòng phẩm
              </p>
            </a>
          </li>
        @endcan

        @can('request_note-process')
          <li class="nav-item">
            <a href="{{ route('process_note.index') }}" class="nav-link" data-link="request_note">
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
            <a href="{{ route('handover_note.index') }}" class="nav-link" data-link="handover_note">
              <p>
                Quản lý phiếu bàn giao
              </p>
            </a>
          </li>
        @endcan

        @can('registration-handover')
          <li class="nav-item">
            <a href="{{ route('handover_registration.list_period') }}" class="nav-link"
              data-link="handover_registration">
              <p>
                Bàn giao đăng ký văn phòng phẩm của đơn vị
              </p>
            </a>
          </li>
        @endcan

        @can('buy_note-manage')
          <li class="nav-item">
            <a href="{{ route('buy_note.index') }}" class="nav-link" data-link="buy_note">
              <p>
                Quản lý phiếu mua của đơn vị
              </p>
            </a>
          </li>
        @endcan

        @can('statistic')
          <li class="nav-item">
            <a href="{{ route('statistic.index') }}" class="nav-link" data-link="statisctic">
              <p>
                Thống kê
              </p>
            </a>
          </li>
        @endcan

        @can('user-manage')
          <li class="nav-item">
            <a href="{{ route('department.index') }}" class="nav-link" data-link="department">
              <p>
                Xem cơ cấu đơn vị
              </p>
            </a>
          </li>
        @endcan

        <li class="nav-item menu-guest">
          <a href="{{ route('limit.index') }}" class="nav-link" data-link="limit">
            <p>
              Hạn mức đăng ký văn phòng phẩm của tôi
            </p>
          </a>
        </li>

        <li class="nav-item menu-guest">
          <a href="{{ route('registration.index') }}" class="nav-link" data-link="registration">
            <p>
              Đăng ký văn phòng phẩm
            </p>
          </a>
        </li>

        <li class="nav-item menu-guest">
          <a href="{{ route('history.index') }}" class="nav-link" data-link="history_registration">
            <p>
              Lịch sử đăng ký văn phòng phẩm của tôi
            </p>
          </a>
        </li>

        <li class="nav-item menu-guest">
          <a href="{{ route('fix_note.index') }}" class="nav-link" data-link="phieu-sua">
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
  {{-- Active Link --}}
  <script src="{{ asset('js/active-link.js') }}"></script>
  <script src="{{ asset('js/combine-menu.js') }}"></script>
  <script>
    $(function() {
      var checkPermisionRequestNote = `{{ auth()->user()->can('request_note-process') }}`;
      if (checkPermisionRequestNote) {
        const channel = 'request-note';
        Echo.private(channel).listen('.RequestNote', (data) => {
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
      }

      var options = {
        'stationery': 'van-phong-pham',
        'equipment': 'thiet-bi',
        'period': 'dot-dang-ky',
        'handover_registration': 'ban-giao-dang-ky',
        'request_note': 'phieu-de-nghi',
        'handover_note': 'phieu-ban-giao',
        'buy_note': 'phieu-mua',
        'statisctic': 'thong-ke',
        'limit': 'han-muc',
        'limit_default': 'han-muc-mac-dinh',
        'registration': 'dang-ky-van-phong-pham',
        'history_registration': 'lich-su-dang-ky',
        'fix_note': 'phieu-sua',
        'limit_process': 'xu-ly-han-muc',
        'department': 'co-cau',
      };
      ActiveLink('.list-menu', options);
    })

    var isCombine = `{{ auth()->user()->id_role !== App\Models\Role::GUEST }}`;
    CombineMenu('.list-menu', !!isCombine ? 'Các chức năng khác của tôi' : undefined);
  </script>
@endpush
