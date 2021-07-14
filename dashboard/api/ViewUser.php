<?php
require_once('../includes/config.php');
$id=$_POST["id"];
$stmt=$db_host->prepare("SELECT * FROM users WHERE id=?");
try{
    $stmt->execute([$id]);
    $rows=$stmt->fetch();
}catch(PDOException $e){
    echo "讀取資料失敗";
}

// var_dump($rows);
echo json_encode($rows);


?>