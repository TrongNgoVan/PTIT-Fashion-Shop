<?php 


//lay id goi edit
$id = $_GET['id'];

//ket noi csdl
require('conn.php');

$sql_str = "select 
* from news where id=$id";
// echo $sql_str; exit;   //debug cau lenh

$res = mysqli_query($conn, $sql_str);

$news = mysqli_fetch_assoc($res);

if (isset($_POST['btnUpdate'])){
   //lay du lieu tu form
   $name = $_POST['title'];
   $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
   $summary = $_POST['summary'];
   $description = $_POST['description'];
  
   $danhmuc = $_POST['danhmuc'];
  
   //xu ly hinh anh
 

   if (!empty($_FILES['anh']['name'])){//có chọn hình ảnh mới - xóa các ảnh cũ
    //xoa anh cu
   
    unlink($news['avatar']);
    
    
    //them anh moi 
    // $imgs = '';
    // for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['anh']['name'];

        ## Location
        $location = "uploads/news/".uniqid().$filename;
                    //pathinfo ( string $path [, int $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ] ) : mixed
        $extension = pathinfo($location,PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        ## File upload allowed extensions
        $valid_extensions = array("jpg","jpeg","png");

        $response = 0;
        ## Check file extension
        if(in_array(strtolower($extension), $valid_extensions)) {

            // them vao CSDL - them thah cong moi upload anh len
            ## Upload file
                                //$_FILES['file']['tmp_name']: $_FILES['file']['tmp_name'] - The temporary filename of the file in which the uploaded file was stored on the server.
            if(move_uploaded_file($_FILES['anh']['tmp_name'],$location)){

                // $imgs .= $location . ";";
            }
        }

    // }

    // echo substr($imgs, 0, -1); exit;
    
    // cau lenh them vao bang
    $sql_str = "UPDATE `news` 
        SET `title`='$name', 
        `slug`='$slug', 
        `description`='$description', 
        `sumary`='$summary', 
        `avatar`='$location', 
        `newscategory_id`=$danhmuc, 
        `updated_at`=now()
        WHERE `id`=$id
        ";
   } else {
    $sql_str = "UPDATE `news` 
        SET `title`='$name', 
        `slug`='$slug', 
        `description`='$description', 
        `sumary`='$summary', 
        `newscategory_id`=$danhmuc, 
        `updated_at`=now()
        WHERE `id`=$id
        ";
   }
   

//    echo $sql_str; exit;

   //thuc thi cau lenh
   mysqli_query($conn, $sql_str);

   //tro ve trang 
   header("location: ./listnews.php");
} else {
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
                        <h1 class="h4 text-gray-900 mb-4">Cập nhật tin tức</h1>
                    </div>
                    <form class="user" method="post" action="#" enctype="multipart/form-data">                        
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user"
                            id="title" name="title" aria-describedby="emailHelp"
                            placeholder="Tên sản phẩm"
                            value="<?=$news['title']?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control form-control-user"
                            id="anh" name="anh" 
                            >
                        <br>
                        Ảnh hiện tại:
                        <?php $avatar = $news['avatar']; ?>
                        <img src='<?=$avatar?>' height='100px' />
                       
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tóm tắt tin:</label>
                        <textarea id="summary-editor" name="summary" class="form-control" placeholder="Nhập...">
                        <?=htmlspecialchars($news['sumary'])?>
                        </textarea>
                    </div>
                    <div class="form-group">
                    <label class="form-label">Nội dung tin:</label>
                        <textarea id="description-editor"  name="description" class="form-control" placeholder="Nhập...">
                        <?=htmlspecialchars($news['description'])?>
                        </textarea>
                    </div>
                    
                   
                   
                   
                    <div class="form-group">
                        <label class="form-label">Danh mục tin tức:</label>
                        <select class="form-control" name="danhmuc">
                            <option>Chọn danh mục</option>
                            <?php 
    // require('../db/conn.php');
    $sql_str = "select * from newscategories order by name";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <option value="<?php echo $row['id'];?>"
            <?php
                if ($row['id'] == $news['newscategory_id'])
                    echo "selected";

            ?>
        ><?php echo $row['name'];?></option>
        <?php } ?>
                        </select>
                    </div>
                    
                    <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
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
      
<?php
require('includes/footer.php');
}
?>