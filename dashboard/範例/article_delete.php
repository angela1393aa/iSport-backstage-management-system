<?php
require_once("./PDO_connect.php");
$id=$_GET["id"];
if(isset($_POST["action"])&&($_POST["action"]=="DELDTE")){
    $result = $db_host->prepare("DELDTE FROM article WHERE id=?");
    $stmt -> bind_param("i", $_POST["id"]);
    $stmt -> execute();
    $stmt->close();
    $db_host->close();
    header('location: article_list.php');
}   
$result = $db_host->prepare("SELECT * FROM article WHERE id=?");
$stmt -> bind_param("i", $_GET["id"]);
$stmt -> execute();
$stmt->bind_result($id, $article_name, $added_by, $upload_date, $content, $category);
$stmt->fetch();
header('location: article_list.php');
    ?>    

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>


        <div class="container">

        <form action="articleUpdate.php" method="post">
                <div class="mb-2" style="text-align: end;">
                    <span>時間:<?=$value["upload_date"]?></span>
                </div>
                <input type="hidden" name="id" value="<?=$id?>">
                <!-- type="hidden"讓使用者看不到 -->
                <div class="mb-2">
                    <label>作者:</label>
                    <input type="text" class="form-control " name="article_name" value="<?=$article_name?>" readonly>
                </div>
                <div class="mb-2">
                    <label>分類:</label>
                    <input type="text" class="form-control" name="category" value="<?=$category?>" readonly>
                </div>
                <div class="mb-2">
                    <label>標題:</label>
                    <input type="text" class="form-control" name="added_by" value="<?=$added_by?>" readonly> 
                </div>
                <div class="mb-2">
                    <label>內容:</label>
                    <textarea class="form-control" rows="30" name="content" readonly><?= $content?></textarea>
                </div>
                
                <div style="text-align: end;">
                    <input type="hidden" class="form-control" name="id" value="<?=$id?>" readonly> 
                    <input type="hidden" class="form-control" name="action" value="delete" readonly>
                    <input type="submit" class="form-control" name="button" value="確定刪除這筆資料嗎?" readonly>
                    <a class="btn btn-info" href="article_list.php">返回</a> 
                </div>
        </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
    $stmt -> close();
    $db_host->close();        
?>