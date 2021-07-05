<?php
require_once("./PDO_connect.php");
if(isset($_POST["action"])&&($_POST["action"]=="UPDATE")){
$sql="UPDATE article SET article_name=?, added_by=?, upload_date=?, content=?, category=? WHERE id=?";//這裡要改
$stmt=$db_host->prepare($sql);
$stmt -> bind_param("sssssi", $_POST["article_name"], $_POST["added_by"], $_POST["upload_date"], $_POST["content"], $_POST["category"], $_POST["id"])
$stmt -> execute();
$stmt -> close();
$db_host -> close();
header('location: article_list.php');
}
$result = $db_host->prepare("SELECT * FROM article WHERE id=?");
$stmt -> bind_param("i", $_GET["id"]);
$stmt -> execute();
$stmt->bind_result($id, $article_name, $added_by, $upload_date, $content, $category);
$stmt->fetch();
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
        </div>
        <div>
        <form action="articleUpdate.php" method="post">
                <div class="mb-2" style="text-align: end;">
                    <span>時間:<?=$value["upload_date"]?></span>
                </div>
                <input type="hidden" name="id" value="<?=$id?>">
                <!-- type="hidden"讓使用者看不到 -->
                <div class="mb-2">
                    <label>作者:</label>
                    <input type="text" class="form-control " name="article_name" value="<?=$article_name?>" >
                </div>
                <div class="mb-2">
                    <label>分類:</label>
                    <input type="text" class="form-control" name="category" value="<?=$category?>" >
                </div>
                <div class="mb-2">
                    <label>標題:</label>
                    <input type="text" class="form-control" name="added_by" value="<?=$added_by?>" > 
                </div>
                <div class="mb-2">
                    <label>內容:</label>
                    <textarea class="form-control" rows="30" name="content" ><?= $content?></textarea>
                </div>

                
                <div style="text-align: end;">
                <input type="hide" class="form-control" name="id" value="<?=$id?>" > 
                <input type="hide" class="form-control" name="action" value="update" > 
                <input type="submit" class="form-control" name="button" value="更新資料" > 
                <input type="reset" class="form-control" name="button2" value="重新填寫" > 
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