<?php
require('conn.php');

// Lấy sản phẩm theo id
$id = (int)$_GET['id'];
$sql = "
  SELECT p.id, p.name AS pname, p.summary, p.description, p.stock, 
         p.price, p.disscounted_price, p.images, p.category_id, p.brand_id,
         c.name AS cname, b.name AS bname
  FROM products p
  JOIN categories c ON p.category_id = c.id
  JOIN brands    b ON p.brand_id    = b.id
  WHERE p.id = $id
";
$product = mysqli_fetch_assoc(mysqli_query($conn, $sql));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu
    $name        = trim($_POST['name']);
    $slug        = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));
    $summary     = $_POST['summary'];
    $description = $_POST['description'];
    $stock       = (int) $_POST['stock'];
    $price       = (float) $_POST['giagoc'];
    $giaban      = (float) $_POST['giaban'];
    $cat_id      = (int) $_POST['danhmuc'];
    $brand_id    = (int) $_POST['thuonghieu'];

    // Xử lý ảnh
    if (!empty($_FILES['anhs']['name'][0])) {
        // Xóa ảnh cũ
        foreach (explode(';', $product['images']) as $img) {
            if (file_exists($img)) unlink($img);
        }
        // Upload ảnh mới
        $imgs = [];
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        foreach ($_FILES['anhs']['tmp_name'] as $idx => $tmp) {
            $orig  = basename($_FILES['anhs']['name'][$idx]);
            $ext   = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png'])) {
                $new   = $upload_dir . uniqid() . "_{$orig}";
                if (move_uploaded_file($tmp, $new)) {
                    $imgs[] = $new;
                }
            }
        }
        $images = implode(';', $imgs);
    } else {
        // Giữ ảnh cũ
        $images = $product['images'];
    }

    // Cập nhật DB
    $sql = "
      UPDATE products SET 
        name = ?, slug = ?, summary = ?, description = ?, 
        stock = ?, price = ?, disscounted_price = ?, 
        images = ?, category_id = ?, brand_id = ?
      WHERE id = ?
    ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
      $stmt, "ssssiidsiii",
      $name, $slug, $summary, $description,
      $stock, $price, $giaban,
      $images, $cat_id, $brand_id,
      $id
    );
    mysqli_stmt_execute($stmt);
    header("Location: listsanpham.php");
    exit;
}

// Nếu là GET, hiển thị form phía dưới
require('includes/header.php');
?>

<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <div class="p-5">
        <h1 class="h4 text-gray-900 mb-4 text-center">Cập nhật sản phẩm</h1>
        <form method="post" enctype="multipart/form-data">
          
          <!-- Tên -->
          <div class="form-group">
            <input type="text" name="name" class="form-control" 
                   placeholder="Tên sản phẩm" 
                   value="<?= htmlspecialchars($product['pname']) ?>" required>
          </div>
          
          <!-- Ảnh mới (nếu có) + hiển thị ảnh cũ -->
          <div class="form-group">
            <label>Các hình ảnh mới (bỏ trống để giữ ảnh cũ)</label>
            <input type="file" name="anhs[]" multiple class="form-control">
            <div class="mt-2">
              <?php foreach (explode(';', $product['images']) as $img): ?>
                <img src="<?= htmlspecialchars($img) ?>" height="80">
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Summary (CKEditor) -->
          <div class="form-group">
            <label>Tóm tắt sản phẩm</label>
            <textarea id="summary-editor" name="summary" class="form-control" rows="4">
<?= htmlspecialchars($product['summary']) ?></textarea>
          </div>

          <!-- Description (CKEditor) -->
          <div class="form-group">
            <label>Mô tả sản phẩm</label>
            <textarea id="description-editor" name="description" class="form-control" rows="6">
<?= htmlspecialchars($product['description']) ?></textarea>
          </div>

          <!-- Stock, Price, Discount -->
          <div class="form-row">
            <div class="col">
              <input type="number" name="stock" class="form-control" 
                     placeholder="Số lượng" 
                     value="<?= $product['stock'] ?>" required>
            </div>
            <div class="col">
              <input type="number" step="0.01" name="giagoc" class="form-control" 
                     placeholder="Giá gốc" 
                     value="<?= $product['price'] ?>" required>
            </div>
            <div class="col">
              <input type="number" step="0.01" name="giaban" class="form-control" 
                     placeholder="Giá bán" 
                     value="<?= $product['disscounted_price'] ?>" required>
            </div>
          </div>

          <!-- Danh mục -->
          <div class="form-group mt-3">
            <label>Danh mục</label>
            <select name="danhmuc" class="form-control" required>
              <option value="" disabled>Chọn danh mục</option>
              <?php
                $cats = mysqli_query($conn, "SELECT id,name FROM categories");
                while ($c = mysqli_fetch_assoc($cats)): ?>
                <option value="<?= $c['id'] ?>"
                  <?= $c['id']==$product['category_id']?'selected':''?>>
                  <?= htmlspecialchars($c['name']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <!-- Thương hiệu -->
          <div class="form-group">
            <label>Thương hiệu</label>
            <select name="thuonghieu" class="form-control" required>
              <option value="" disabled>Chọn thương hiệu</option>
              <?php
                $bds = mysqli_query($conn, "SELECT id,name FROM brands");
                while ($b = mysqli_fetch_assoc($bds)): ?>
                <option value="<?= $b['id'] ?>"
                  <?= $b['id']==$product['brand_id']?'selected':''?>>
                  <?= htmlspecialchars($b['name']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <button type="submit" class="btn btn-primary" name="btnUpdate">
            Cập nhật
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- CKEditor từ CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  [ 'summary-editor', 'description-editor' ].forEach(id => {
    ClassicEditor
      .create(document.getElementById(id), {
        toolbar: [
          'heading','|','bold','italic','underline','link',
          'bulletedList','numberedList','insertTable','imageUpload',
          'blockQuote','undo','redo'
        ],
        ckfinder: {
          uploadUrl: 'fileupload.php'
        }
      })
      .catch(err => console.error(err));
  });
</script>

<?php require('includes/footer.php'); ?>

