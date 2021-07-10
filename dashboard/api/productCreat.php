<?php
require_once('../includes/config.php');

$productSkuSql = "SELECT * FROM product_sku WHERE valid = 1";


$productSkuStmt = $db_host->prepare($productSkuSql);

try {

    $productSkuStmt->execute();


    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);


               //形成json檔
} catch (PDOException $e) {
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}
$db_host=null;
?>