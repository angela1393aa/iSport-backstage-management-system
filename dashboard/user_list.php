<?php 
require_once("includes/header.php"); 
require_once("Userlist.php"); 

?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title row">
            <div class="title_left col-10">
                <h3>會員列表</h3>
                <div class="h6">共有<?=$no?>位會員</div>
            </div>
            <div class="title_right col-2">
            <a href="user_create.php"><button type="button" class="btn btn-info btn-lg" >新增會員</button></a>
            </div>

            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>帳號</th>
                        <th>信箱</th>
                        <th>手機</th>
                        <th>生日</th>
                        <th>編輯</th>
                    </tr>
                </thead>
                <?php  foreach($rows as $row)
                {?>
                    <tbod>
                        <tr>
                            <td><?=$row["user_name"]?></td>
                            <td><?=$row["account"]?></td>
                            <td><?=$row["email"]?></td>
                            <td><?= "0".$row["phone"]?></td>
                            <td><?=$row["birthday"]?></td>
                            <td><a class="btn btn-info" href="user.php?id=<?=$row["id"]?>">瀏覽</a> <a class="btn btn-danger" href="deleteUser.php?id=<?=$row["id"]?>">刪除</a></td>
                        </tr> 
                    </tbody>
                <?php } ?>
               
            </table>
                            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <?php for($i=1; $i<=$pages ;$i++){?>
                    <li class="page-item"><a class="page-link" href="user_list.php?p=<?=$i?>"><?=$i?></a></li>
                    <?php } ?>
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
                </nav>
        </div>
    </div>
</div>
<!-- /page content -->




<?php require_once("includes/footer.php"); ?>
