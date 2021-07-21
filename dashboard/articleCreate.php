<?php
session_start();
require_once("includes/config.php");
$article_name = $_POST["article_name"];
$added_by = $_POST["added_by"];
$content = $_POST["content"];
$category = $_POST["category"];
$upload_date = date('Y-m-d H:i:s');
date_default_timezone_set("Asia/Taipei");
$file_name=$_FILES["file"]["name"];
$photos=$file_name;
$_SESSION['article']=['article_name'=>$article_name, 'added_by'=>$added_by, 'content'=>$content];
if (
    empty($_POST['article_name']) || empty($_POST['added_by']) || empty($_POST['content'])
 ) {   
   echo '資料有缺，請再次填寫<br>';
   header("refresh:1 ; url=article_create.php");
   exit(); 
}
if($_FILES["file"]["error"]==0){
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "images/article_upload/". $_FILES["file"]["name"])){
        echo "Upload success!<br>";
    }else{
        echo "Upload fail!!<br>";
    }
}
$sql="INSERT INTO article (article_name, added_by, upload_date, content, category, photos) VALUES (?,?,?,?,?,?)";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute([$article_name, $added_by, $upload_date, $content, $category, $photos]);
    echo "新增資料成功";
}catch(PDOException $e){
    echo "新增資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}
unset($_SESSION['article']);
$_SESSION['article']['article_name']=$_SESSION['article']['added_by']=$_SESSION['article']['content']='';
// $db_host->close();
header('location: article_list.php');
?>