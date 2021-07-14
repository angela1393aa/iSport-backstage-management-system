<?php
require_once('../includes/config.php');

// 用PDO將資料庫資料提取 -> 轉成json檔 -> 再以js方式取得json檔裡的資訊

$userOrderSql = "SELECT * FROM user_order WHERE valid = 1";
$usersSql = "SELECT id, account, phone, address FROM users WHERE valid = 1";
$orderStatusSql = "SELECT * FROM order_status";


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
    $userAddressArr = [];
    $userPhoneArr = [];

    // 從users資料表撈account及address
    foreach ($usersRows as $row){
        $userArr[$row['id']] = $row['account'];
        $userAddressArr[$row['id']] = $row['address'];
        $userPhoneArr[$row['id']] = $row['phone'];
    }
    // print_r($userAddressArr);


    $orderStatusArr = [];
    $orderArr = [];
    
    // 從order_status資料表撈出狀態
    foreach ($orderStatusRows as $row){
        $orderStatusArr[$row['id']] = $row['status'];
    }
    // print_r($orderStatusArr);

    $arr = [];
    foreach ($userOrderRows as $row){
        $arr = [
            'order_date' => $row['order_date'],
            'order_id' => $row['id'],
            'order_no' => $row['order_no'],
            'user_id' => $row['user_id'],
            'user_account' => $userArr[$row['user_id']],
            'phone' => "0".$userPhoneArr[$row['user_id']],
            'address' => $userAddressArr[$row['user_id']],
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

?>