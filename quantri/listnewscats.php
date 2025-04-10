<?php 
require('includes/header.php');
?>



<div>
<style>
    .btn-danger { 
    color: white !important;  
    background-color: rgb(178, 5, 5) !important;  
    border-color: rgb(178, 5, 5) !important;
}

    .btn-warning{  
        color: white !important;  
        background-color: rgb(31, 91, 222) !important;  
        border-color: rgb(37, 57, 242) !important;
    }
    .btn-warning:hover{
        color: black !important;  
        background-color: rgb(41, 105, 243) !important;  
        border-color: rgb(59, 78, 250) !important;
    }
    .btn-danger:hover{ 
    color: black !important;  
    background-color: rgb(209, 4, 4) !important;  
    border-color: rgb(178, 5, 5) !important;
}
</style>

    

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh mục tin tức</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                               
                                    <tbody>
                                    <?php 
    require('../db/conn.php');
    $sql_str = "select * from newscategories order by name";
    $result = mysqli_query($conn, $sql_str);
    while ($row = mysqli_fetch_assoc($result)){
        ?>

        
            <tr>
                <td><?=$row['name']?></td>
                <td><?=$row['slug']?></td>
                <td><?=$row['status']?></td>
                <td>
                    <a class="btn btn-warning" href="editnewscategory.php?id=<?=$row['id']?>">Edit</a>  
                    <a class="btn btn-danger" 
                    href="deletenewscategory.php?id=<?=$row['id']?>"
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