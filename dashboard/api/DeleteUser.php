<?php
require_once('../includes/config.php');

if(isset($_POST["Deletemeber"])){
    $id=$_POST["Deletemeber"];
}else{
    echo "請依正確方式傳遞";
    exit;
}

// $id=$_POST["Deletemeber"];

$sql ="UPDATE users SET valid=0 WHERE id=?";
$stmt = $db_host->prepare($sql);

try{
    $stmt->execute([$id]);
    echo "修改資料成功";
}catch(PDOException $e){
    echo "修改資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

header('location: ../axios_user_list.php');

?>

