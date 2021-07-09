<?php
require_once("./config.php");


$article_name = $_POST["article_name"];
$added_by = $_POST["added_by"];
$content = $_POST["content"];
$category = $_POST["category"];
$upload_date = date('Y-m-d H:i:s');//取得目前時間

$sql="UPDATE article SET article_name=?, added_by=?, upload_date=?, content=?, category=? WHERE id=?";//這裡要改
$stmt=$db_host->prepare($sql);


try{
    $stmt->execute([$article_name, $added_by, $upload_date, $content, $category]);
    echo "修改資料成功";

}catch(PDOException $e){
    echo "修改資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

$db_host->close();
header('location: article-list.php?id='.$id);
?> 