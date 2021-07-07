<?php
require_once('../includes/config.php');

$categorySql = "SELECT * FROM product_category";
$categoryStmt = $db_host->prepare($categorySql);

try{
    $categoryStmt->execute();
    $rows = $categoryStmt->fetchAll(PDO::FETCH_ASSOC); 
    echo json_encode($rows);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}
?>