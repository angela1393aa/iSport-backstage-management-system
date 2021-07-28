<?php
require_once('includes/config.php');

// if(!isset($_POST["account"])){
//     echo "請選擇會員帳號";
//     exit();
//     header("location: href=''");
// }

//***************************寫入user_order***************************
$sql = "INSERT INTO user_order (user_id, recipient, phone, address, order_date, order_no, paytype, order_status, valid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$orderDetailSql = "INSERT INTO user_order_detail (order_id, product_id, qty) VALUES (?, ?, ?)";

//***************************查找***************************
$usersSql = "SELECT id, account, address FROM users WHERE valid = 1";
$productSkuSql = "SELECT id, product_id, sku_code FROM product_sku WHERE valid = 1";


$stmt = $db_host->prepare($sql);
$orderDetailStmt = $db_host->prepare($orderDetailSql);
$usersStmt = $db_host->prepare($usersSql);
$productSkuStmt = $db_host->prepare($productSkuSql);

try{
    // 找到key為account的id value
    $usersStmt->execute();
    $productSkuStmt->execute();

    $userRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);

    $userArr = [];
    $productSkuArr = [];

    foreach ($userRows as $row){
        $userArr[$row["account"]] = $row["id"];
    };
    foreach ($productSkuRows as $productSkuRow){
        $productSkuArr[$productSkuRow["sku_code"]] = $productSkuRow["id"];
    };
    print_r($productSkuArr);

    $recipient = $_POST["account"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $user_id = $userArr["$recipient"];
    $order_date = date("Y-m-d H:i:s");
    $order_id = $db_host->lastInsertId($sql);
    $order_no = "";
    $paytype = $_POST["paytype"];
    $order_status = $_POST["order_status"];
    $valid = 1;
    // $invoice_no = $_POST["invoice"]; invoice no出貨時同時建立
    
    //先$stmt->execute, 才能抓到lastInsertId(), 但是我的$order_no變數需要抓$order_id的值
    $stmt->execute([$user_id, $recipient, $phone, $address, $order_date, $order_no, $paytype, $order_status, $valid]);
    $order_id = $db_host->lastInsertId($sql);  //PDO 取得上一筆新增的序號(user_order資料表的id), 必須execute後才可以產生
    
    $sku_id = $_POST["skuCode"];
    $product_id = $productSkuArr["$sku_id"];
    $qty = $_POST["qty"];
    $orderDetailStmt->execute([$order_id, $product_id, $qty]);

    //UPDATE 為了在取得$stmt->execute()後使用lastInsertId()的id序號
    $order_no = date("ym")."ORD".date("d").$order_id;
    $updateSql = "UPDATE user_order SET order_no = ? WHERE id = ?";
    $updateStmt = $db_host->prepare($updateSql);
    $updateStmt->execute([$order_no, $order_id]);

    header("location: user_order.php");


}catch(PDOException $e){
    echo "資料庫新增失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}


?>