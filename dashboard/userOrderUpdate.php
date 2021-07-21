<?php
require_once('includes/config.php');

$id = $_POST['id'];  //在user_order_update.php 設定input type="hidden" name="id"
$recipient = $_POST['recipient'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$paytype = $_POST['paytype'];
$delivery = $_POST['delivery'];
$order_status = $_POST['orderStatus'];

$userOrderSql = "UPDATE user_order SET recipient = ?, phone = ?, address = ?, paytype = ?, delivery = ?, order_status = ? WHERE id = ?";

$userOrderStmt = $db_host->prepare($userOrderSql);

try{
    $userOrderStmt->execute([$recipient, $phone, $address, $paytype, $delivery, $order_status, $id]);

    header("location: user_order.php");

}catch(PDOException $e){
    echo "資料庫修改失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}



?>