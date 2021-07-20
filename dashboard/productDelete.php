<?php
require_once('includes/config.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

// $id = 3;
$productSkuSql = "SELECT  id FROM product_sku WHERE valid = 1 AND product_id=?";
$productSkuStmt = $db_host->prepare($productSkuSql);

$productDeleteSql = "UPDATE product SET valid=0 WHERE id=?";
$productDeleteStmt = $db_host->prepare($productDeleteSql);

$productSkuDeleteSql = "UPDATE product_sku SET valid=0 WHERE id=?";
$productSkuDeleteStmt = $db_host->prepare($productSkuDeleteSql);


try {
    $productSkuStmt->execute([$id]);
    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);

    $productDeleteStmt->execute([$id]);

    foreach($productSkuRows as $row){
        $skuId = $row['id'];
        // echo $skuId . '<br>';
        $productSkuDeleteStmt->execute([$skuId]);
    }

} catch (PDOException $e) {
    echo "讀取資料失敗";
}
$db_host = null;
header('location: product_list.php');
