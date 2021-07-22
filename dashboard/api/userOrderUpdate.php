<?php
require_once('../includes/config.php');

$userOrderSql = "SELECT * FROM user_order WHERE valid = 1";
$usersSql = "SELECT id, account FROM users WHERE valid = 1";
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

    foreach ($usersRows as $usersRow) {
        $userArr[$usersRow['id']] = $usersRow['account'];
    }

    $orderStatusArr = [];
    foreach ($orderStatusRows as $orderStatusRow){
        $orderStatusArr[$orderStatusRow['id']] = $orderStatusRow['status'];
    }

    $userOrderArr = [];
    $usersArr = [];
    $resultArr = [];

    foreach ($userOrderRows as $userOrderRow) {
        $arr = [
            'order_date' => $userOrderRow['order_date'],
            'order_id' => $userOrderRow['id'],
            'order_no' => $userOrderRow['order_no'],
            'recipient' => $userOrderRow['recipient'],
            'user_id' => $userOrderRow['user_id'],
            'user_account' => $userArr[$userOrderRow['user_id']],
            'phone' => [$userOrderRow['phone']],
            'address' => [$userOrderRow['address']],
            'order_status' => $orderStatusArr[$userOrderRow['order_status']],
            'invoice_no' => $userOrderRow['invoice_no'],
            'paytype' => $userOrderRow['paytype'],
            'delivery' => $userOrderRow['delivery'],
        ];
        array_push($resultArr, $arr);
    }

    echo json_encode($resultArr);

} catch (PDOException $e) {
    echo "資料庫查詢失敗<br>";
    echo "Error: " . $e->getMessage() . "<br>";
    exit;
}
