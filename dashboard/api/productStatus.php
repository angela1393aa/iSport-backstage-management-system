<?php
require_once('../includes/config.php');

$statusSql = "SELECT * FROM product_status";
$statusStmt = $db_host->prepare($statusSql);

try{
    $statusStmt->execute();
    $rows = $statusStmt->fetchAll(PDO::FETCH_ASSOC); 
    echo json_encode($rows);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}
?>