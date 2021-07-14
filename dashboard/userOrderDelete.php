<?php
require_once('includes/config.php');

$id = $_GET["id"];

$userOrderSql = "UPDATE user_order SET valid = 0 WHERE id = ?";
$userOrderStmt = $db_host->prepare($userOrderSql);
$userOrderStmt->execute([$id]);

try{
    header("location: user_order.php");

}catch (PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e -> getMessage(). "<br>";
    exit;
}
// echo "資料庫連結成功";

// 資料庫操作完, 再將資料庫連結關閉
// $db_host=null;

?>
