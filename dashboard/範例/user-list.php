<?php
require_once("./PDO_connect.php");
$row = $db_host->query("SELECT * FROM article");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>
<body>
    <div class="container">
        <div class="row">
        <div class="pb-2 d-flex justify-content-end">
                <a class="btn btn-secondary" href="user-list.php">文章列表</a>
                <a class="btn btn-warning" href="create-user.php">新增文章</a>
        </div>

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>序號</th>
                            <th>作者</th>
                            <th>分類</th>
                            <th>標題</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($row as $row){
                    ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["article_name"]?></td>
                            <td>
                            <?php 
                                switch($row["category"]){
                                    case('1'):
                                        echo '有氧';
                                    break;
                                    case('2'):
                                        echo '健身';
                                    break;
                                    case('3'):
                                        echo 'tabata';
                                    break;
                                    case('4'):
                                        echo '飲食';
                                    break;
                                    case('5'):
                                        echo '核心';
                                    break;
                                }

                            ?>
                            </td>
                            <td><?php echo $row["added_by"]?></td>
                            <!-- <td><?php echo $row["content"]?></td> -->
                            <td><?php echo $row["upload_date"]?></td>
                            <td>
                            <a class="btn btn-info" href="user.php?id=<?php echo $row["id"]?>">瀏覽</a>
                            <a class="btn btn-danger" href="deleteUser.php?id=<?php echo $row["id"]?>">刪除</a>
                            <a class="btn btn-success" href="update-user.php?id=<?php echo $row["id"]?>">修改</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
            </table>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>