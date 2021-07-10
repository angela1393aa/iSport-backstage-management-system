<?php
require_once('../includes/config.php');

$brandSql = "SELECT id, name FROM brand WHERE valid = 1";
$categorySql = "SELECT id, name FROM product_category WHERE valid = 1";
$productTypeSql = "SELECT id, name_frontend AS name FROM product_type";


$brandStmt = $db_host->prepare($brandSql);
$categoryStmt = $db_host->prepare($categorySql);
$productTypeStmt = $db_host->prepare($productTypeSql);

try {
    $brandStmt->execute();
    $categoryStmt->execute();
    $productTypeStmt->execute();

    $brandRows = $brandStmt->fetchAll(PDO::FETCH_ASSOC);
    $categoryRows = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
    $productTypeRows = $productTypeStmt->fetchAll(PDO::FETCH_ASSOC);

    $jArr = [
        'brand' => $brandRows,
        'category' => $categoryRows,
        'productType' => $productTypeRows
    ];

    echo json_encode($jArr);           //形成json檔
} catch (PDOException $e) {
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}
$db_host=null;
