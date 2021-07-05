<?php
if(isset($_POST["action"])&&($_POST["action"]=="ADD")){
require_once("./PDO_connect.php");
$sql="INSERT INTO article (article_name, added_by, upload_date, content, category) VALUES (?,?,?,?,?)";//這裡要改
$stmt=$db_host->prepare($sql);
$stmt -> bind_param("sssss", $_POST["article_name"], $_POST["added_by"], $_POST["upload_date"], $_POST["content"], $_POST["category"])
$stmt -> execute();
$stmt -> close();
$db_host -> close();

header('location: article_list.php');
}
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
        <form action="articleCreate.php" method="post">

            <div class="mb-2">
                <label for="article_name">作者</label>
                <input type="text" class="form-control" name="article_name" id="article_name" required>
            </div>
            <div class="mb-2">
                <label for="category">分類</label>
                <select name="category" id="category">
                    <option value="1">有氧</option>
                    <option value="2">重訓</option>
                    <option value="3">tabata</option>
                    <option value="4">核心</option>
                    <option value="5">飲食</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="added_by">標題</label>
                <input type="text" class="form-control" name="added_by" id="added_by" required>
            </div>
            <div class="mb-2">
                <label for="content">內容</label>
                <input type="text" class="form-control" name="content" id="content" required>
            </div>
            <div class="mb-2">
                <input type="hidden" class="form-control" name="action" value="add" required>
                <input type="submit" class="form-control" name="button" value="新增資料" required>
                <input type="reset" class="form-control" name="button2" value="重新填寫" required>
            </div>
            
            
            <button class="btn btn-info" type="submit">新增</button>
        </form>
        </div>
    </div>  
</div>
</body>
</html>