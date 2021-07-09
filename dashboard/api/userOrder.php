<?php
require_once('../includes/config.php');

$userOrderSql = 'SELECT * FROM user_order';
$usersSql = 'SELECT id, account FROM users WHERE valid = 1';
$orderStatusSql = 'SELECT * FROM order_status';


$userOrderStmt = $db_host->prepare($userOrderSql);
$usersStmt = $db_host->prepare($usersSql);
$orderStatusStmt = $db_host->prepare($orderStatusSql);

try {
    $userOrderStmt->execute();
    $usersStmt->execute();
    $orderStatusStmt->execute();

    $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);
    $usersRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $orderStatusRows = $orderStatusStmt->fetchAll(PDO::FETCH_ASSOC);

    $userArr = [];
    $orderStatusArr = [];
    $orderArr = [];

    // 從product_sku資料表撈sku_code
    foreach ($usersRows as $row){
        $userArr[$row['id']] = $row['account'];
    }
    // print_r($userArr);
    
    foreach ($orderStatusRows as $row){
        $orderStatusArr[$row['id']] = $row['status'];
    }
    // print_r($orderStatusArr);

    $arr = [];
    foreach ($userOrderRows as $row){
        $arr = [
            'order_date' => $row['order_date'],
            'order_id' => $row['id'],
            'user_id' => $row['user_id'],
            'user_account' => $userArr[$row['user_id']],
            'order_status' => $orderStatusArr[$row['order_status']],
            'invoice_no' => $row['invoice_no'],
            'paytype' => $row['paytype'],
        ];
        array_push($orderArr, $arr);
    }
    // print_r($orderArr);
    echo json_encode($orderArr);




} catch (PDOException $e) {
    echo '資料庫連結失敗<br>';
    echo 'Eroor: ' . $e->getMessage() . '<br>';
    exit;
}
