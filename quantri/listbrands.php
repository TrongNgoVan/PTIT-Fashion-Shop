<?php 
require('includes/header.php');
?>



<div>


    

<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
</div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Slug</th>
                
                <th>Status</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Brand</th>
                <th>Slug</th>
                
                <th>Status</th>
                <th>Operation</th>
            </tr>
        </tfoot>
        <tbody>
<?php 
    require('../db/conn.php');
    $sql_str = "select * from brands order by id";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
        ?>

        
            <tr>
                <td><?=$row['name']?></td>
                <td><?=$row['slug']?></td>
                <td><?=$row['status']?></td>
                <td>
                    <a class="btn btn-warning" href="editbrand.php?id=<?=$row['id']?>">Edit</a>  
                    <a class="btn btn-danger" 
                    href="deletebrand.php?id=<?=$row['id']?>"
                    onclick="return confirm('Bạn chắc chắn xóa mục này?');">Delete</a>
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