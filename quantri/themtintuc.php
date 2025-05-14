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
                            <h1 class="h4 text-gray-900 mb-4">Thêm mới tin tức</h1>
                        </div>
                        <form class="user" method="post" action="addnews.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    aria-describedby="emailHelp" placeholder="Tiêu đề tin tức">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Hình đại diện cho tin</label>
                                <input type="file" class="form-control form-control-user" id="anh" name="anh">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tóm tắt tin:</label>
                                <textarea id="summary-editor" name="sumary" class="form-control" placeholder="Nhập...">

                        </textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nội dung tin:</label>
                                <textarea id="description-editor" name="description" class="form-control" placeholder="Nhập...">

                        </textarea>
                            </div>




                            <div class="form-group">
                                <label class="form-label">Danh mục tin:</label>
                                <select class="form-control" name="danhmuc">
                                    <option>Chọn danh mục</option>
                                    <?php
                                    require('conn.php');
                                    $sql_str = "select * from newscategories order by name";
                                    $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button class="btn btn-primary">Tạo mới</button>
                        </form>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
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