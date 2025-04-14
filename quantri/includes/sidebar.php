<style>
  .bg-gradient-primary {
  background-color:rgb(185, 18, 18) !important;  /* Màu đỏ đậm */
  background-image: linear-gradient(180deg,rgb(183, 28, 28) 10%,rgb(168, 5, 5) 100%) !important;
  width: 18% !important; /* Chiều rộng 100% */
}
.sidebar .nav-item a {
    font-size: 16px; /* Kích thước chữ */
    font-weight: bold; /* Làm đậm chữ */
}
.sidebar .nav-item .nav-link {
    font-size: 15px !important; /* Tăng kích thước chữ */
    font-weight: bold !important; /* Làm đậm chữ */
}
.sidebar .nav-item .nav-link span {
    font-size: 15px !important; /* Tăng kích thước chữ cho phần <span> */
}


</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-user-shield"></i> <!-- Icon quản trị viên -->
    </div>
    <div class="sidebar-brand-text mx-3">Quản trị</div>
</a>


  <!-- Divider -->
  <hr class="sidebar-divider my-0" />

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" />

  <!-- Heading -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
      aria-controls="collapseOne">
      <i class="fas fa-calendar-day"></i>
      <span>Thương hiệu - Brand</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="collapseOne" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
   
        <a class="collapse-item" href="./listbrands.php">Liệt kê</a>
        <a class="collapse-item" href="./themthuonghieu.php">Thêm mới</a>
      </div>
    </div>
  </li>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-calendar-day"></i>
      <span>Danh mục sản phẩm</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
    
        <a class="collapse-item" href="./listcats.php">Liệt kê</a>
        <a class="collapse-item" href="./themdanhmuc.php">Thêm mới</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBanner" aria-expanded="true" aria-controls="collapseBanner">
      <i class="fas fa-image"></i>
      <span>Banner quảng cáo</span>
    </a>
    <div id="collapseBanner" class="collapse" aria-labelledby="headingBanner" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="./listbanner.php">Liệt kê</a>
        <a class="collapse-item" href="./thembanner.php">Thêm mới</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVoucher" aria-expanded="true" aria-controls="collapseVoucher">
    <i class="fas fa-ticket-alt"></i>
    <span>Voucher</span>
  </a>
  <div id="collapseVoucher" class="collapse" aria-labelledby="headingVoucher" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="./listvoucher.php">Liệt kê</a>
      <a class="collapse-item" href="./themvoucher.php">Thêm mới</a>
    </div>
  </div>
</li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fab fa-product-hunt"></i>
      <span>Sản phẩm</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">

        <a class="collapse-item" href="./listsanpham.php">Liệt kê</a>
        <a class="collapse-item" href="./themsanpham.php">Thêm mới</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDMTT" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-calendar-day"></i>
      <span>Danh mục tin tức</span>
    </a>
    <div id="collapseDMTT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
    
        <a class="collapse-item" href="./listnewscats.php">Liệt kê</a>
        <a class="collapse-item" href="./themdanhmuctintuc.php">Thêm mới</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTT" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fab fa-product-hunt"></i>
      <span>Tin tức</span>
    </a>
    <div id="collapseTT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
    
        <a class="collapse-item" href="./listnews.php">Liệt kê</a>
        <a class="collapse-item" href="./themtintuc.php">Thêm mới</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-wallet"></i>
      <span>Đơn hàng</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
   
        <a class="collapse-item" href="./listorders.php">Liệt kê</a>
        <a class="collapse-item" href="#">Thêm mới</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-users"></i>
      <span>Người dùng</span>
    </a>
    <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
 
        <a class="collapse-item" href="#">Liệt kê</a>
        <a class="collapse-item" href="#">Thêm mới</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider" />


 


</ul>
<!-- End of Sidebar -->