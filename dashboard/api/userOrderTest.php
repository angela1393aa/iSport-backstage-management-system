<?php
require_once('../includes/config.php');

    $search = $_GET["search"];

    $userOrderSql = "SELECT * FROM user_order WHERE CONCAT(recipient, phone, address, invoice_no, order_date, order_no, paytype, delivery) LIKE :search AND valid = 1";
    $usersSql = "SELECT id, account, phone, address FROM users WHERE CONCAT(id, account, phone) LIKE :search AND valid = 1";
    $orderStatusSql = "SELECT * FROM order_status WHERE CONCAT(id, status) LIKE :search";

    $userOrderStmt = $db_host->prepare($userOrderSql);
    $usersStmt = $db_host->prepare($usersSql);
    $orderStatusStmt = $db_host->prepare($orderStatusSql);

    $search = "%".$search."%";

    $userOrderStmt->bindParam(':search', $search);
    $usersStmt->bindParam(':search', $search);
    $orderStatusStmt->bindParam(':search', $search);

    $userOrderStmt->execute();
    $usersStmt->execute();
    $orderStatusStmt->execute();

    $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);
    $usersRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $orderStatusRows = $orderStatusStmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($userOrderRows);

    try {
        $userOrderStmt->execute();
        $usersStmt->execute();
        $orderStatusStmt->execute();
    
        $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);
        $usersRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
        $orderStatusRows = $orderStatusStmt->fetchAll(PDO::FETCH_ASSOC);
    
        // 從users資料表撈account, address及phone
        $userArr = [];
        $userAddressArr = [];
        $userPhoneArr = [];
        foreach ($usersRows as $row){
            $userArr[$row['id']] = $row['account'];
            $userAddressArr[$row['id']] = $row['address'];
            $userPhoneArr[$row['id']] = $row['phone'];
        }
        // print_r($userAddressArr);
    
        
        // 從order_status資料表撈出狀態
        $orderStatusArr = [];
        $orderArr = [];
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
                'recipient' => $row['recipient'],
                'user_id' => $row['user_id'],
                'user_account' => $userArr[$row['user_id']],
                'phone' => [$row['phone']],
                'address' => [$row['address']],
                'order_status' => $orderStatusArr[$row['order_status']],
                'invoice_no' => $row['invoice_no'],
                'paytype' => $row['paytype'],
                'delivery' => $row['delivery'],
            ];
            array_push($orderArr, $arr);
        }
        // print_r($orderArr);
        echo json_encode($orderArr);
    
    } catch (PDOException $e) {
        echo '資料庫連結失敗<br>';
        echo 'Error: ' . $e->getMessage() . '<br>';
        exit;
    }
?>