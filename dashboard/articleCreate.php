<?php
require_once("includes/config.php");

if (
    empty($_POST['article_name']) || empty($_POST['added_by']) || empty($_POST['content'])
 ) {
   echo '資料有缺，請再次填寫<br>';
   //header('location: article_list.php');
   exit(); 
}

$article_name = $_POST["article_name"];
$added_by = $_POST["added_by"];
$content = $_POST["content"];
$category = $_POST["category"];
$upload_date = date('Y-m-d H:i:s');
date_default_timezone_set("Asia/Taipei");

$sql="INSERT INTO article (article_name, added_by, upload_date, content, category) VALUES (?,?,?,?,?)";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$article_name, $added_by, $upload_date, $content, $category]);
    echo "新增資料成功";

}catch(PDOException $e){
    echo "新增資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

// $db_host->close();

header('location: article_list.php');
?>