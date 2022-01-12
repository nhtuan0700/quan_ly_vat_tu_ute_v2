@extends('welcome.layout')

@section('body')
<div class="body-content d-flex flex-column align-items-center">
  <div class="item d-flex flex-column align-items-center">
    <h4 class="text-bold">Giới thiệu</h4>
    <div class="content">
      <h5 class="text-primary text-bold">1. Cơ cấu hệ thống</h5>
      <div class="text-center">
        <img src="{{ asset('img/co_cau_to_chuc.png') }}" alt="" class="w-75">
      </div>
      
      <h5 class="text-primary text-bold">2. Quy trình</h5> 
      <div class="text-center text-bold">
        Mua sắm văn phòng phẩm
      </div>
      <div class="text-center">
        <img src="{{ asset('img/mua.jpg') }}" alt="" class="w-75">
      </div>

      <div class="text-center text-bold">
        Sửa chữa thiết bị
      </div>
      <div class="text-center">
        <img src="{{ asset('img/sua.jpg') }}" alt="" class="w-75">
      </div>
      
      <h5 class="text-primary text-bold">3. Cơ cấu đơn vị</h5>
      <div class="card">
        <div class="card-body">
          <h5>Khoa</h5> 
          <div class="row">
            <div class="col-md-6">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Mã khoa</th>
                    <th scope="col">Tên khoa</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (\App\Models\Department::where('is_room', false)->get() as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="col-md-3 ml-5">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Các chức vụ ở đơn vị khoa</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (\App\Models\Position::where('is_room', false)->get() as $item)
                    <tr>
                      <td>{{ $item->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="card-body">
          <h5>Phòng ban</h5> 
          <div class="row">
            <div class="col-md-6">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Mã phòng ban</th>
                    <th scope="col">Tên phòng ban</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (\App\Models\Department::where('is_room', true)->get() as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="col-md-3 ml-5">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Các chức vụ ở đơn vị phòng ban</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (\App\Models\Position::where('is_room', true)->get() as $item)
                    <tr>
                      <td>{{ $item->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</div>
@endsection