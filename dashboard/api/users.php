<?php
require_once('../includes/config.php');
require_once('../UserCount.php');


if(!isset($_GET["p"])){
    $p=1;
}else{
    $p=$_GET["p"];
}
$per_page=7;
$star_item=($p-1)*$per_page;
$stmt=$db_host->prepare("SELECT * FROM users WHERE valid=1");
// $stmt=$db_host->prepare("SELECT * FROM users WHERE valid=1 LIMIT $star_item,$per_page");
// 已使用datatable 模板

try{
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "讀取資料失敗";
}

// var_dump($rows);
echo json_encode($rows);


?>