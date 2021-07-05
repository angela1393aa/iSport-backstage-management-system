<?php
require_once("./PDO_connect.php");
$result = $db_host->query("SELECT * FROM article");
$total_records = $result->num_rows
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
    <div class="container">
        <div class="row">
        <div class="pb-2 d-flex justify-content-end">
                <a class="btn btn-secondary" href="article_list.php">文章列表</a>
                <a class="btn btn-warning" href="article_create.php">新增文章</a>
                <p>目前文章筆數:<?php echo $total_records;?></p>
        </div>

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>序號</th>
                            <th>作者</th>
                            <th>分類</th>
                            <th>標題</th>
                            <th>內容</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row_result=$result->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row_result["id"] ?></td>
                            <td><?php echo $row_result["article_name"]?></td>
                            <td>
                            <?php 
                                switch($row_result["category"]){
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
                            <td><?php echo $row_result["added_by"]?></td>
                            <td><?php echo $row_result["content"]?></td>
                            <td><?php echo $row_result["upload_date"]?></td>
                            <td>
                            <a class="btn btn-info" href="article_read.php?id=<?php echo $row_result["id"]?>">瀏覽</a> 
                            <a class="btn btn-danger" href="article_delete.php?id=<?php echo $row_result["id"]?>">刪除</a>
                            <a class="btn btn-success" href="article_update.php?id=<?php echo $row_result["id"]?>">修改</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
            </table>
            
        </div>
    </div>
</body>
</html>