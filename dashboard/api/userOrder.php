<?php
require_once('../includes/config.php');

// $sql="SELECT product.name AS product_name, product.price, users.name AS user_name, user_order.*
// FROM user_order
// JOIN users ON user_order.user_id = users.id
// JOIN product ON user_order.product_id = product.id
// ORDER BY user_order.id DESC
// ";

$sql = "SELECT * FROM user_order";
$detailSql = "SELECT * FROM user_order_detail";
$productSql = "SELECT * FROM product_sku";
$stmt = $db_host->prepare($sql);
$detailStmt = $db_host->prepare($detailSql);
$productStmt = $db_host->prepare($productSql);



try{
    $stmt -> execute();
    $detailStmt -> execute();
    $productStmt -> execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $detailRows = $detailStmt->fetchAll(PDO::FETCH_ASSOC);
    $productRows = $detailStmt->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($rows);
    $orderArr = [];
    $orderDetailArr = [];
    foreach ($detailRows as $detailRow){
        $detailArray[$detailRow['order_id']] = $row['product_id'];
    }
    foreach ($productRows as $productRow){
        ""
        $detailArray[$detailRow['order_id']] = $row['product_id'];
    }

    foreach ($rows as $row){
        // echo "<div>".$row["account"]."</div>";
        $data=[
            "order_id"=>$row["id"],
            "user_id"=>$row["user_id"],
            "invoice_no"=>$row["invoice_no"],
            "order_date"=>$row["order_date"],
            "order_status"=>$row["order_status"],
        ];
            array_push($orderArr, $data);
    }
    // print_r($orderArr);
    // echo json_encode($orderArr);

    
    

}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

?>