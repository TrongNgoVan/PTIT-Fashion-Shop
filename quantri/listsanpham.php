<?php 
require('includes/header.php');

function anhdaidien($arrstr,$height){
    //$arrstr la mang cac anh co dang anh1;anh2;anh3
    //tach chuoi nay thanh mang - tach voi ;
    // $arr = $arrstr.split(';');
    $arr = explode(';', $arrstr);
    return "<img src='$arr[0]' height='$height' />";
}
?>



<div>


    

<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh đại diện</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>                    
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh đại diện</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>                    
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </tfoot>
            <tbody>
            <?php 
    require('../db/conn.php');
    $sql_str = "select 
    products.id as pid,
    products.name as pname,
    images,
    categories.name as cname,
    brands.name as bname,
    products.status as pstatus
    from products, categories, brands where products.category_id=categories.id and products.brand_id = brands.id order by products.name";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
        ?>

        
            <tr>
                <td><?=$row['pname']?></td>
                <td><?=anhdaidien($row['images'], "100px")?></td>
                <td><?=$row['cname']?></td>
                <td><?=$row['bname']?></td>
                <td><?=$row['pstatus']?></td>
                <td>
                    <a class="btn btn-warning" href="editproduct.php?id=<?=$row['pid']?>">Edit</a>  
                    <a class="btn btn-danger" 
                    href="deleteproduct.php?id=<?=$row['pid']?>"
                    onclick="return confirm('Bạn chắc chắn xóa sản phẩm này?');">Delete</a>
                </td>
                
            </tr>
            <?php
    }
    ?>                                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
         

      
<?php
require('includes/footer.php');
?>