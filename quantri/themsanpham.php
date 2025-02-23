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
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user"
                            id="name" name="name" aria-describedby="emailHelp"
                            placeholder="Tên sản phẩm">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Các hình ảnh cho sản phẩm</label>
                        <input type="file" class="form-control form-control-user"
                            id="anhs" name="anhs[]" 
                            multiple>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tóm tắt sản phẩm:</label>
                        <textarea name="sumary" class="form-control" placeholder="Nhập...">

                        </textarea>
                    </div>
                    <div class="form-group">
                    <label class="form-label">Mô tả sản phẩm:</label>
                        <textarea name="description" class="form-control" placeholder="Nhập...">

                        </textarea>
                    </div>
                    
                   
                    <div class="form-group row">
                        <div class="col-sm-4 mb-sm-0">
                        <input type="text" class="form-control form-control-user"
                            id="stock" name="stock" aria-describedby="emailHelp"
                            placeholder="Số lượng nhập:"> 
                        </div>
                        <div class="col-sm-4 mb-sm-0">
                        <input type="text" class="form-control form-control-user"
                            id="giagoc" name="giagoc" aria-describedby="emailHelp"
                            placeholder="Giá gốc">
                        </div>
                        <div class="col-sm-4 mb-sm-0">
                        <input type="text" class="form-control form-control-user"
                            id="giaban" name="giaban" aria-describedby="emailHelp"
                            placeholder="Giá bán:">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="form-label">Danh mục:</label>
                        <select class="form-control" name="danhmuc">
                            <option>Chọn danh mục</option>
                            <?php 
    require('../db/conn.php');
    $sql_str = "select * from categories order by name";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label class="form-label">Thương hiệu:</label>
                   
                        <select class="form-control" name="thuonghieu">
                        <option>Chọn thương hiệu</option>

                        <?php 
    require('../db/conn.php');
    $sql_str = "select * from brands order by name";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
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

      
<?php
require('includes/footer.php');
?>