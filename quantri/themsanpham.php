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
              <h1 class="h4 text-gray-900 mb-4">Thêm mới sản phẩm</h1>
            </div>
          
            <form class="user" method="post" action="addproduct.php" enctype="multipart/form-data">                        
              
              <!-- Tên sản phẩm -->
              <div class="form-group">
                <input type="text" class="form-control form-control-user"
                  id="name" name="name"
                  placeholder="Tên sản phẩm">
              </div>
              
              <!-- Ảnh sản phẩm -->
              <div class="form-group">
                <label class="form-label">Các hình ảnh cho sản phẩm</label>
                <input type="file" class="form-control form-control-user"
                  id="anhs" name="anhs[]" multiple>
              </div>

              <!-- Tóm tắt (CKEditor) -->
              <div class="form-group">
                <label class="form-label">Tóm tắt sản phẩm:</label>
                <textarea id="summary-editor" name="summary" class="form-control" placeholder="Nhập tóm tắt..."></textarea>
              </div>

              <!-- Mô tả (CKEditor) -->
              <div class="form-group">
                <label class="form-label">Mô tả sản phẩm:</label>
                <textarea id="description-editor" name="description" class="form-control" placeholder="Nhập mô tả..."></textarea>
              </div>
              
              <!-- Thông tin khác -->
              <div class="form-group row">
                <div class="col-sm-4 mb-sm-0">
                  <input type="text" class="form-control form-control-user"
                    id="stock" name="stock"
                    placeholder="Số lượng nhập">
                </div>
                <div class="col-sm-4 mb-sm-0">
                  <input type="text" class="form-control form-control-user"
                    id="giagoc" name="giagoc"
                    placeholder="Giá gốc">
                </div>
                <div class="col-sm-4 mb-sm-0">
                  <input type="text" class="form-control form-control-user"
                    id="giaban" name="giaban"
                    placeholder="Giá bán">
                </div>
              </div>

              <!-- Danh mục -->
              <div class="form-group">
                <label class="form-label">Danh mục:</label>
                <select class="form-control" name="danhmuc">
                  <option>Chọn danh mục</option>
                  <?php 
                    require('conn.php');
                    $sql_str = "SELECT * FROM categories ORDER BY name";
                    $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                  <?php } ?>
                </select>
              </div>

              <!-- Thương hiệu -->
              <div class="form-group">
                <label class="form-label">Thương hiệu:</label>
                <select class="form-control" name="thuonghieu">
                  <option>Chọn thương hiệu</option>
                  <?php 
                    $sql_str = "SELECT * FROM brands ORDER BY name";
                    $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                  <?php } ?>
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Tạo mới</button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Nhúng CKEditor 5 từ CDN -->
 
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  function initCKEditor(textareaId) {
    ClassicEditor
      .create(document.querySelector('#' + textareaId), {
        toolbar: [
          'heading','|','bold','italic','underline','link',
          'bulletedList','numberedList',
          'insertTable','imageUpload','blockQuote',
          'undo','redo'
        ],
        ckfinder: {
          // phải trỏ đúng đến file PHP xử lý
          uploadUrl: 'fileupload.php'
        }
      })
      .catch(error => console.error(error));
  }
  // Gọi cho cả hai editor
  initCKEditor('summary-editor');
  initCKEditor('description-editor');
</script>



<?php
require('includes/footer.php');
?>
