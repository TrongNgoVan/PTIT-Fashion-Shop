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
    <h6 class="m-0 font-weight-bold text-primary">Blog</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Ảnh đại diện</th>
                    <th>Danh mục</th>
                   
                    <th>Hành động</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Ảnh đại diện</th>
                    <th>Danh mục</th>
                   
                    <th>Hành động</th>
                </tr>
            </tfoot>
            <tbody>
            <?php 
    require('../db/conn.php');
    $sql_str = "select 
    *, news.id as nid
    from news, newscategories where 
    news.newscategory_id = newscategories.id
    order by news.created_at";
    $result = mysqli_query($conn, $sql_str);
    $stt = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $stt++;
        ?>

        
            <tr>
                <td><?=$stt?></td>
                <td><?=$row['title']?></td>
                <td><img src='<?=$row['avatar']?>' height='100px' /></td>
                <td><?=$row['name']?></td>
                
                <td>
                    <a class="btn btn-warning" href="editnews.php?id=<?=$row['nid']?>">Edit</a>  
                    <a class="btn btn-danger" 
                    href="deletenews.php?id=<?=$row['nid']?>"
                    onclick="return confirm('Bạn chắc chắn xóa tin tức này?');">Delete</a>
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