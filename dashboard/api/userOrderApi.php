<?php
require_once('../includes/config.php');

// 用PDO將資料庫資料提取 -> 轉成json檔 -> 再以js方式取得json檔裡的資訊

    $userOrderSql = "SELECT * FROM user_order WHERE valid = 1 ORDER BY id DESC";
    $usersSql = "SELECT id, account, phone, address FROM users";
    $orderStatusSql = "SELECT * FROM order_status";
    $orderDetailSql = "SELECT * FROM user_order_detail";
    $productSql = "SELECT id, name FROM product";
    $productSkuSql = "SELECT id, product_id, sku_code FROM product_sku";

    $userOrderStmt = $db_host->prepare($userOrderSql);
    $usersStmt = $db_host->prepare($usersSql);
    $orderStatusStmt = $db_host->prepare($orderStatusSql);
    $orderDetailStmt = $db_host->prepare($orderDetailSql);
    $productStmt = $db_host->prepare($productSql);
    $productSkuStmt = $db_host->prepare($productSkuSql);


try {
    $userOrderStmt->execute();
    $usersStmt->execute();
    $orderStatusStmt->execute();
    $orderDetailStmt->execute();
    $productStmt->execute();
    $productSkuStmt->execute();

    $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);
    $usersRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $orderStatusRows = $orderStatusStmt->fetchAll(PDO::FETCH_ASSOC);
    $userOrderDetailRows = $orderDetailStmt->fetchAll(PDO::FETCH_ASSOC);
    $productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);
    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);

    // 將user_order欄位paytype及delivery改為代號, 以便select取值
    $paytype = [
        'ATM匯款' => '1',
        '線上刷卡' => '2',
        '貨到付款' => '3',
    ];
    $delivery = [
        '郵寄' => '1',
        '宅急便' => '2',
        '超商取貨' => '3',
    ];

    $userArr = [];
    $userAddressArr = [];
    $userPhoneArr = [];
    $orderStatusArr = [];
    $orderArr = [];
    $orderUpdateArr = [];
    $resultUserOrderDetailIdArr = [];
    $userOrderDetailIdArray = [];
    $productSkuArr = [];
    $arr = [];
    $arr1 =[];
    $userOrderDetailArr = [];

    // 從users資料表撈account, address及phone
    foreach ($usersRows as $row){
        $userArr[$row['id']] = $row['account'];
        $userAddressArr[$row['id']] = $row['address'];
        $userPhoneArr[$row['id']] = $row['phone'];
    }

    // 從order_status資料表撈出狀態
    foreach ($orderStatusRows as $orderStatusRow){
        $orderStatusArr[$orderStatusRow['id']] = $orderStatusRow['status'];
    }

    $productArr = [];
    foreach ($productRows as $productRow){
        $productArr[$productRow["id"]] = $productRow["name"];
    };

    foreach ($userOrderDetailRows as $userOrderDetailRow){
        // $arrUserOrderDetail = [
            //$userOrderDetailRow['id']] => $userOrderDetailRow['order_id'],
            $userOrderDetailIdArray[$userOrderDetailRow['id']] = $userOrderDetailRow['order_id'];
        // ];
        // array_push($resultUserOrderDetailIdArr, $arrUserOrderDetail);
    }
        // echo json_encode($userOrderDetailIdArray);

    foreach ($productSkuRows as $productSkuRow){
        $productSkuArr[$productSkuRow["id"]] = $productSkuRow["sku_code"];
        $productSkuIdArr[$productSkuRow["sku_code"]] = $productSkuRow["product_id"];
    };

    // **************** for ORDER LIST ****************
    foreach ($userOrderRows as $userOrderRow){
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
            'user_order_detail_id' => $userOrderDetailIdArray[$userOrderDetailRow['id']],
            $userOrderRow['id'] =>  $userOrderRow['id'],
        ];
        array_push($orderArr, $arr);
    }

    // **************** for UPDATE ****************
    foreach ($userOrderRows as $userOrderRow){
        $arr = [
            $userOrderRow['id'] =>  $userOrderRow['id'],
            'order_date' => $userOrderRow['order_date'],
            'order_id' => $userOrderRow['id'],
            'order_no' => $userOrderRow['order_no'],
            'recipient' => $userOrderRow['recipient'],
            'user_id' => $userOrderRow['user_id'],
            'user_account' => $userArr[$userOrderRow['user_id']],
            'phone' => [$userOrderRow['phone']],
            'address' => [$userOrderRow['address']],
            'invoice_no' => $userOrderRow['invoice_no'],
            'user_order_detail_id' => $userOrderDetailIdArray[$userOrderDetailRow['id']],
            'order_status' => $userOrderRow['order_status'],
            // ************* (SELECT value要是option的value(設定為數字))***************
            'paytype' => $paytype[$userOrderRow['paytype']],
            'delivery' => $delivery[$userOrderRow['delivery']],
        ];
        array_push($orderUpdateArr, $arr);
    }

    // **************** for UPDATE ****************
    foreach ($userOrderDetailRows as $userOrderDetailRow){
        // $userOrderDetailArr[$userOrderDetailRow['id']] = $userOrderDetailRow['order_id'];
        $arr1 = [
            'id' => $userOrderDetailRow['id'],
            'order_id' => $userOrderDetailRow['order_id'],
            'product_sku_id' => $userOrderDetailRow['product_id'],
            'qty' => $userOrderDetailRow['qty'],
            'sku_code' => $productSkuArr[$userOrderDetailRow['product_id']],
            'product_id' => $productSkuIdArr[$productSkuArr[$userOrderDetailRow['product_id']]],
            'name' => $productArr[$productSkuIdArr[$productSkuArr[$userOrderDetailRow['product_id']]]],
        ];
        array_push($userOrderDetailArr, $arr1);
    }

    // 陣列$orderArr與陣列$userOrderDetailArr合併成 $combineArr
    $combineArr = [
        'userOrder' => $orderArr,
        'userOrderUpdate' => $orderUpdateArr,
        'userOrderDetail' => $userOrderDetailArr,
    ];

    echo json_encode($combineArr);
    // echo json_encode($orderUpdateArr);

} catch (PDOException $e) {
    echo '資料庫連結失敗<br>';
    echo 'Error: ' . $e->getMessage() . '<br>';
    exit;
}

?>