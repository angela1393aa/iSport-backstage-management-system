<?php
require_once('../includes/config.php');
$stmt=$db_host->prepare("SELECT * FROM users");
try{
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "讀取資料失敗";
}

// var_dump($rows);
echo json_encode($rows);


?>