@extends('master')
@section('title')
  Thống kê
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="form-row form-row-0">
                <div class="form-group d-flex align-items-center col-2">
                  <label for="" class="mr-1">Tháng</label>
                  <select class="form-control" name="month" id="month">
                    <option value>Tất cả</option>
                  </select>
                </div>
                <div class="form-group d-flex align-items-center col-2">
                  <label for="" class="mr-1">Năm</label>
                  <select class="form-control" name="year" id="year">

                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Mua văn phòng phẩm</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body row">
                  <div class="col-md-6">
                    <div class="info-box">
                      <span class="info-box-icon bg-success elevation-1">
                        <i class="fas fa-clipboard"></i>
                      </span>
                      <div class="info-box-content">
                        <span class="info-box-text">Phiếu đề nghị</span>
                        <span class="info-box-number">{{ optional($data['notes'])[1] ?? 0 }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box">
                      <span class="info-box-icon bg-danger elevation-1">
                        <i class="fas fa-coins"></i>
                      </span>
                      <div class="info-box-content">
                        <span class="info-box-text">Chi phí</span>
                        <span class="info-box-number">{{ format_currency($data['cost_buy_total']) }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Sửa chữa thiết bị</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body row">
                  <div class="col-md-6">
                    <div class="info-box">
                      <span class="info-box-icon bg-success elevation-1">
                        <i class="fas fa-clipboard"></i>
                      </span>
                      <div class="info-box-content">
                        <span class="info-box-text">Phiếu đề nghị</span>
                        <span class="info-box-number">{{ optional($data['notes'])[0] ?? 0 }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box">
                      <span class="info-box-icon bg-danger elevation-1">
                        <i class="fas fa-coins"></i>
                      </span>
                      <div class="info-box-content">
                        <span class="info-box-text">Chi phí</span>
                        <span class="info-box-number">{{ format_currency($data['cost_fix_total']) }}</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Danh sách tổng hợp các đơn vị</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Mã đơn vị</th>
                    <th>Tên đơn vị</th>
                    <th class="text-center">Phiếu mua</th>
                    <th class="text-center">Phiếu sửa</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($data['departments'] as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-center">{{ $item->count_buy }}</td>
                        <td class="text-center">{{ $item->count_fix }}</td>
                      </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Tình trạng thiết bị</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                Tổng số thiết bị: {{ $data['equipments_request']->total }}
                <canvas id="donutChart"
                  style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>

      <div class="col-12">
        <!-- BAR CHART -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Biểu đồ chi phí năm {{ request()->year ?? now()->year }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <script>
    $(function() {
      var months = [];
      for (let i = 1; i <= 12; i++) {
        months.push(`Tháng ${i}`)
      }
      var optionMonths = [];
      var monthRequest = `{{ request()->month }}`
      for (let m = 12; m >= 1; m--) {
        optionMonths.push(`<option value="${m}" ${m == monthRequest ? 'selected' : ''}>Tháng ${m}</option>`)
      }
      var optionYears = [];
      var date = new Date();
      var yearRequest = `{{ request()->year }}`
      for (let y = date.getFullYear(); y >= 2020; y--) {
        optionYears.push(`<option value="${y}" ${y == yearRequest ? 'selected' : ''}>Năm ${y}</option>`)
      }
      $('#month').append(optionMonths.join(''))
      $('#year').append(optionYears.join(''))

      $('#month').change(function() {
        var month = $(this).val();
        var year = $('#year').val();
        window.location = `?month=${month}&year=${year}`
      })
      $('#year').change(function() {
        var month = $('#month').val();
        var year = $(this).val();
        window.location = `?month=${month}&year=${year}`
      })

      //-------------
      //- DONUT CHART -
      //-------------
      var equipments_request = @json($data['equipments_request']);
      console.log(equipments_request);
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var donutData = {
        labels: [
          'Bình thường',
          'Đang sửa',
          'Hỏng'
        ],
        datasets: [{
          data: [equipments_request['fixable'], equipments_request['fixing'], equipments_request['broken']],
          backgroundColor: ['#00a65a', '#f39c12', '#f56954'],
        }]
      }
      var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        cutout: 'string'
      }
      new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })
      var cost_buy = @json($data['cost_buy']);
      var cost_fix = @json($data['cost_fix']);

      var cost_fix_label = [];
      var cost_buy_label = [];

      for (let m = 1; m <= 12; m++) {
        cost_buy_label.push(cost_buy[m] || 0)
        cost_fix_label.push(cost_fix[m] || 0)
      }

      //-------------
      //- BAR CHART -
      //-------------
      var areaChartData = {
        labels: months,
        datasets: [{
            label: 'Sửa chữa thiết bị',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: cost_fix_label
          },
          {
            label: 'Mua văn phòng phẩm',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: cost_buy_label
          },
        ]
      }
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    })
  </script>
@endsection
