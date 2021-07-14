<?php
require_once('includes/config.php');

$address = $_POST['address'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$email = $_POST['email'];

$userOrderSql = "SELECT * FROM user_order ";
$usersSql = "SELECT address FROM users";

$usersStmt = $db_host->prepare($usersSql);

try{
    $userOrderStmt->execute();
    $usersStmt->execute();
    $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);

    $userOrderArr = [];

    foreach ($userOrderRows as $row){
        $userOrderArr[$row['id']] = $row['order_no'];
    }

    


    header("location: user_order.php");


}catch(PDOException $e){
    echo "資料庫新增失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}



?>