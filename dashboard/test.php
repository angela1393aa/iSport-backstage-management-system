<?php
require_once ('includes/config.php');

$sql = "SELECT product_sku.sku_code,product_sku.sku_group, product_sku.price AS product_sku_price, product_sku.stock,product_sku.Sales, product.*
    	FROM product
    	JOIN product_sku ON product.id = product_sku.product_id";
$stmt = $db_host->prepare($sql);
$sql2 = "SELECT * FROM product_type_value";
$stmt2 = $db_host->prepare($sql2);
//var_dump($stmt);
try {
    $stmt->execute();
    $stmt2->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($rows2);
    $typeArr = [];
    foreach ($rows2 as $row2){
        $typeArr[$row2['id']] = $row2['type_value'];
    }
//    var_dump($typeArr);
    foreach ($rows as $row) {
        var_dump($row['name'],$row['sku_code'], $row['sku_group']);
        $arr = explode(',',$row['sku_group']);
        foreach ($arr as $key){
            if(!empty($key)){
                echo $typeArr[$key] . ' ';
            }
        }
        echo '<br>';
    }
} catch (PDOException $e) {
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}
?>