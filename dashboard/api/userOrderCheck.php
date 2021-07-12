<?php
require_once('../includes/config.php');
$account=$_POST["account"];
$usersSql = "SELECT account FROM users WHERE account = ? AND valid = 1";
$usersStmt = $db_host->prepare($usersSql);
$usersStmt->execute([$account]);

try{
    $count = $usersStmt->rowCount();
    $data = array(
        "status" => 1,
        "count" => $count,
    );
    echo json_encode($data);

}catch(PDOException $e){
    // echo "資料庫連結失敗<br>";
    // echo "Error: ".$e->getMessage(). "<br>";
    $data = array(
        "status" => 0,
        "message" => $e -> getMessage(),
    );
    echo json_encode($data);
    exit;
}

?>
