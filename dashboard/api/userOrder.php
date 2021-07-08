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
$productSkuSql = "SELECT * FROM user_order_detail";
$stmt = $db_host->prepare($sql);
$detailStmt = $db_host->prepare($detailSql);



try{
    $stmt -> execute();
    $detailStmt -> execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $detailRows = $detailStmt->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($rows);

    $orderArr = array();
    foreach($rows as $row){
        // echo "<div>".$row["account"]."</div>";
        $data=array(
            "order_id"=>$row["id"],
            "user_id"=>$row["user_id"],
            "invoice_no"=>$row["invoice_no"],
            "order_date"=>$row["order_date"],
            "order_status"=>$row["order_status"],
        );
        array_push($orderArr, $data);
    }
    // print_r($orderArr);
    // echo json_encode($orderArr);

    $orderDetailArr = array();
    foreach($detailRows as $detailRow){
        // echo "<div>".$row["account"]."</div>";
        $data=array(
            // "order_id"=>$detailRow["order_id"],
            "product_id"=>$detailRow["product_id"],
            "qty"=>$detailRow["qty"],
        );
        array_push($orderDetailArr, $data);
    }
    // print_r($orderDetailArr);
    // echo json_encode($orderDetailArr);
    
    $arrayMerge = array_merge($orderArr, $orderDetailArr);
    echo json_encode($arrayMerge);
    

}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

?>