@extends('master')
@section('title')
  Cơ cấu đơn vị
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
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
  </div>
  </div>
@endsection
