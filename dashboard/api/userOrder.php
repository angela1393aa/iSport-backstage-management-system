<?php
require_once('../includes/config.php');

$sql = "SELECT * FROM user_order";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($rows);


}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

?>