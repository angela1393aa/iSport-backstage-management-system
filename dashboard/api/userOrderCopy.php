<?php
require_once('../includes/config.php');

// $sql='SELECT product.name AS product_name, product.price, users.name AS user_name, user_order.*
// FROM user_order
// JOIN users ON user_order.user_id = users.id
// JOIN product ON user_order.product_id = product.id
// ORDER BY user_order.id DESC
// ';

$sql = 'SELECT * FROM user_order';
$detailSql = 'SELECT * FROM user_order_detail';
$productSql = 'SELECT * FROM product_sku';
$stmt = $db_host->prepare($sql);
$detailStmt = $db_host->prepare($detailSql);
$productStmt = $db_host->prepare($productSql);

try{
    $stmt -> execute();
    $detailStmt->execute();
    $productStmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $detailRows = $detailStmt->fetchAll(PDO::FETCH_ASSOC);
    $productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($rows);

    $orderArr = [];
    $orderDetailArr = [];
    $productArr = [];
    // $arr = [];

    // 從user_order_detail資料表撈product_id
    foreach ($detailRows as $row){
        $orderDetailArr[$row['order_id']] = $row['product_id'];
        // 有點奇怪, 一個key應該對一個value, 但我一個order_id會對多個product_id
    }

    // 從product_sku資料表撈sku_code
    foreach ($productRows as $row){
        $productArr[$row['id']] = $row['sku_code'];
    }



    // 
    foreach ($rows as $row){
        // echo '<div>'.$row['account'].'</div>';
        $resultArr=[
            'order_id' => $row['id'],
            'user_id' => $row['user_id'],
            'invoice_no' => $row['invoice_no'],
            //'product_id' =>  $productArr[$orderDetailArr[$row['order_id']]],  // 撈出user_order_detail的product_id,再撈出product_sku的sky_code
            'order_date' => $row['order_date'],
            'paytype' => $row['paytype'],
            'order_status' => $row['order_status'],
        ];
            array_push($arr, $resultArr);
    }
    // print_r($orderArr);
    echo json_encode($arr);

    

}catch(PDOException $e){
    echo '資料庫連結失敗<br>';
    echo 'Eroor: '.$e->getMessage(). '<br>';
    exit;
}

?>