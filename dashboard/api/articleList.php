<?php
require_once("../includes/config.php");
//連線
$stmt=$db_host->prepare("SELECT id, article_name, added_by, upload_date, content, category FROM article");


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