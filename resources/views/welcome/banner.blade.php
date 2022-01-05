<div class="banner">
  <div id="carousel" class="carousel slide carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="item-carousel">
          <img src="{{ asset('img/banner1.png') }}" class="d-block w-100" alt="...">
          <div class="description">
            <h3 class="title">Hệ thống quản lý vật tư</h3>
            <p class="content">Ứng dụng công nghệ thông tin giúp giải quyết các yêu cầu dễ dàng nhanh chóng hơn</p>
            <a href="{{ route('index') }}" class="btn btn-outline-light">Đến hệ thống</a>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="item-carousel">
          <img src="{{ asset('img/banner3.png') }}" class="d-block w-100" alt="...">
          <div class="description">
            <h2 class="title">Hệ thống quản lý vật tư</h2>
            <p class="content">Việc quản lý các quy trình mua sắm, sửa chữa chính xác & bảo mật hơn</p>
            <a href="{{ route('index') }}" class="btn btn-outline-light">Đến hệ thống</a>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="item-carousel">
          <img src="{{ asset('img/banner2.png') }}" class="d-block w-100" alt="...">
          <div class="description">
            <h2 class="title">Hệ thống quản lý vật tư</h2>
            <p class="content">Quản lý được thông tin tình trạng các thiết bị tại trường</p>
            <a href="{{ route('index') }}" class="btn btn-outline-light">Đến hệ thống</a>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev carousel-button" type="button" data-target="#carousel" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next carousel-button" type="button" data-target="#carousel" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>
</div>