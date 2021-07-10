<?php
require_once("./config.php");

$id = $_POST['id'];
$sql="DELETE FROM article WHERE id=?";//這裡要改
// $sql="UPDATE article SET valid=1  WHERE id=?";
$stmt=$db_host->prepare($sql);
//建立資料表命名方式用底線的
//$stmt->bind_param('i',$id);
//	valid=1被刪掉的
try{
    $stmt->execute([$id]);
    echo "刪除資料成功";
}catch(PDOException $e){
    echo "刪除資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

 //$db_host->close();

header('location: article_list.php');
?>