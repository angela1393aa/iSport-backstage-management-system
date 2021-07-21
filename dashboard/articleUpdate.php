<?php
require_once("includes/config.php");
if (
    empty($_POST['article_name']) || empty($_POST['added_by']) || empty($_POST['content'])
 ) {
   echo '資料有缺，請再次填寫<br>';
   header("refresh:1 ; url=article_list.php");
   exit(); 
}
$id = $_POST['id'];
$article_name = $_POST["article_name"];
$added_by = $_POST["added_by"];
$content = $_POST["content"];
$category = $_POST["category"];
$upload_date = date('Y-m-d H:i:s');
$sql="UPDATE article SET article_name=?, added_by=?, upload_date=?, content=?, category=? WHERE id=?";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute([$article_name, $added_by, $upload_date, $content, $category, $id]);
    echo "修改資料成功";
}catch(PDOException $e){
    echo "修改資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}
//$db_host->close();
header('location: article_list.php');
?> 