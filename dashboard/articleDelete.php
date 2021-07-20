<?php
require_once("includes/config.php");
$id = $_POST['id'];
//$sql="DELETE FROM article WHERE id=?";//hard delete
$sql="UPDATE article SET valid=0  WHERE id=?";//soft delete
//0是被刪掉的1要顯示在頁面
$stmt=$db_host->prepare($sql);
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