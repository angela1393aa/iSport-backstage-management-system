<?php
require_once('../includes/config.php');

// 用PDO將資料庫資料提取 -> 轉成json檔 -> 再以js方式取得json檔裡的資訊
// 取得品名及料號
$userSql = "SELECT id, account FROM users WHERE valid = 1";

$userStmt = $db_host->prepare($userSql);


try{
    $userStmt->execute();

    $userRows = $userStmt->fetchAll(PDO::FETCH_ASSOC);

    $userArr = [];
    $arr = [];
    $resultArr = [];

    foreach ($userRows as $userRow){
        $userArr[$userRow["id"]] = $userRow["account"];
        $arr = [
            "id" => $userRow["id"],
            "account" => $userRow["account"],
        ];
        array_push($resultArr, $arr);

    };
        echo json_encode($resultArr);

}catch (PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e -> getMessage(). "<br>";
    exit;
}

?>