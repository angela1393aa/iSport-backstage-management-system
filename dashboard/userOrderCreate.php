<?php
require_once('includes/config.php');

// if(!isset($_SESSION["user"])){
//     echo "請先登入帳號";
//     exit();
//     header("location: user_order_create.php");
// }

//寫入user_order
$sql = "INSERT INTO user_order (user_id, order_date, paytype, order_status) VALUES (?, ?, ?, ?)";
$usersSql = "SELECT id, account, address FROM users WHERE valid = 1";
$orderDetailSql = "INSERT INTO user_order_detail (order_id, product_id, qty) VALUES (?, ?, ?)";

$stmt = $db_host->prepare($sql);
$usersStmt = $db_host->prepare($usersSql);
$orderDetailStmt = $db_host->prepare($orderDetailSql);


try{
    // 找到key為account的id value
    $usersStmt->execute();
    $userRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $userArr = [];
    foreach ($userRows as $row){
        $userArr[$row["account"]] = $row["id"];
    };
    // print_r($userArr);

    $order_id = $db_host->lastInsertId();  //PDO 取得上一筆新增的序號(訂單編號)
    $user_id = $userArr[$row["account"]];
    $invoice_no = $_POST["invoice"];
    $order_date = date("Y-m-d H:i:s");
    $paytype = $_POST["paytype"];
    $order_status = $_POST["order_status"];
    $product_id = $_POST["productId"];
    $qty = $_POST["qty"];

    $stmt->execute([$user_id, $order_date, $paytype, $order_status]);
    $orderDetailStmt->execute([$order_id, $product_id, $qty]);

    header("location: user_order.php");



}catch(PDOException $e){
    echo "資料庫新增失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}


?>