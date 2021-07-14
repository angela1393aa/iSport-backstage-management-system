<?php
require_once('includes/config.php');

// if(!isset($_SESSION["user"])){
//     echo "請先登入帳號";
//     exit();
//     header("location: user_order_create.php");
// }

//寫入user_order
$sql = "INSERT INTO user_order (user_id, order_date, order_no, paytype, order_status, valid) VALUES (?, ?, ?, ?, ?, ?)";
$usersSql = "SELECT id, account, address FROM users WHERE valid = 1";

//寫入user_order_detail
$orderDetailSql = "INSERT INTO user_order_detail (order_id, product_id, qty) VALUES (?, ?, ?)";

$stmt = $db_host->prepare($sql);
$usersStmt = $db_host->prepare($usersSql);
$orderDetailStmt = $db_host->prepare($orderDetailSql);
//$order_id = $db_host->lastInsertId($sql);  //PDO 取得上一筆新增的序號(user_order資料表的id)


try{
    // 找到key為account的id value
    $usersStmt->execute();
    $userRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $userArr = [];
    foreach ($userRows as $row){
        $userArr[$row["account"]] = $row["id"];
    };
    // print_r($userArr);

    $account = $_POST["account"];
    $user_id = $userArr["$account"];
    // $invoice_no = $_POST["invoice"];
    $order_date = date("Y-m-d H:i:s");
    $order_no = date("ym")."ORD".date("d").$order_id;
    $paytype = $_POST["paytype"];
    $order_status = $_POST["order_status"];
    $valid = 1;
    
    
    $product_id = $_POST["productId"];
    $qty = $_POST["qty"];

    //我要先$stmt->execute, 才能抓到lastInsertId(), 但是我的$order_no變數需要抓$order_id的值
    $stmt->execute([$user_id, $order_date, $order_no, $paytype, $order_status, $valid]);
    $order_id = $db_host->lastInsertId($sql);  //PDO 取得上一筆新增的序號(user_order資料表的id)
    $orderDetailStmt->execute([$order_id, $product_id, $qty]);

    header("location: user_order.php");



}catch(PDOException $e){
    echo "資料庫新增失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}


?>