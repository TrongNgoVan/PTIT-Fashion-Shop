<?php  
require('includes/header.php');
?>

<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-12">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Thêm mới Mã Giảm Giá</h1>
            </div>
            <form class="user" method="post" action="addvoucher.php" enctype="multipart/form-data">
              <div class="form-group">
                <label class="form-label">Mã giảm giá:</label>
                <input type="text" class="form-control form-control-user" id="code" name="code" placeholder="Nhập mã giảm giá" required>
              </div>
              <div class="form-group">
                <label class="form-label">Loại giảm giá:</label>
                <select class="form-control" name="loai_giam_gia" id="loai_giam_gia" required>
                  <option value="tien">Theo tiền</option>
                  <option value="phan_tram">Theo phần trăm</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Giá trị giảm:</label>
                <input type="number" step="0.01" class="form-control form-control-user" id="gia_tri_giam" name="gia_tri_giam" placeholder="Nhập giá trị giảm" required>
              </div>
              <div class="form-group">
                <label class="form-label">Điều kiện giảm (đơn hàng tối thiểu):</label>
                <input type="number" step="0.01" class="form-control form-control-user" id="dieu_kien_giam" name="dieu_kien_giam" placeholder="Nhập điều kiện giảm" required>
              </div>
              <div class="form-group">
                <label class="form-label">Mô tả:</label>
                <textarea class="form-control form-control-user" id="mo_ta" name="mo_ta" placeholder="Nhập mô tả voucher"></textarea>
              </div>
              <div class="form-group">
                <label class="form-label">Hình ảnh voucher:</label>
                <input type="file" class="form-control form-control-user" id="image" name="image">
              </div>
              <div class="form-group">
                <label class="form-label">Ngày hết hạn:</label>
                <input type="date" class="form-control form-control-user" id="ngay_het_han" name="ngay_het_han">
              </div>
              <div class="form-group">
                <label class="form-label">Số lượt giới hạn:</label>
                <input type="number" class="form-control form-control-user" id="so_luot_gioi_han" name="so_luot_gioi_han" placeholder="Nhập số lượt giới hạn" value="10" required>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">Tạo mới</button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require('includes/footer.php');
?>
