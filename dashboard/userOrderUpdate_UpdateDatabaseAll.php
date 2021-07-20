<?php
require_once('includes/config.php');

// 一次UPDATE database資料表的所有資料

$usersSql = "SELECT id, phone, address, account FROM users WHERE valid = 1";
$userOrderSql = "SELECT * FROM user_order";
$userOrderCountSql = "SELECT id FROM user_order";

$usersStmt = $db_host->prepare($usersSql);
$userOrderStmt = $db_host->prepare($userOrderSql);
$userOrderCountStmt = $db_host->prepare($userOrderCountSql);

$userOrderCountStmt->execute();
$count = $userOrderCountStmt->rowCount(); // 取得user_order筆數


try{
    $usersStmt->execute();
    $userOrderStmt->execute();

    $usersRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);
    
    $userOrderArr = [];
    $usersPhoneArr = [];
    $usersAddressArr = [];
    $usersRecipientArr = [];

    for ($i = 1; $i <= $count; $i++){  //user_order從第一筆跑到最後一筆
        foreach ($userOrderRows as $userOrderRow){
            $userOrderArr[$userOrderRow["id"]] = $userOrderRow["user_id"];
            foreach ($usersRows as $usersRow){  
                if ($userOrderArr["$i"] == $usersRow["id"]){
                    $usersPhoneArr[$usersRow["id"]] = $usersRow["phone"];
                    $usersAddressArr[$usersRow["id"]] = $usersRow["address"];
                    $usersRecipientArr[$usersRow["id"]] = $usersRow["account"];
                    
                    $phone = $usersPhoneArr[$usersRow["id"]];
                    $address = $usersAddressArr[$usersRow["id"]];
                    $recipient = $usersRecipientArr[$usersRow["id"]];
                    
                    $userOrderUpdateSql = "UPDATE user_order SET phone = ?, address = ?,recipient = ? WHERE id = $i";
                    $userOrderUpdateStmt = $db_host->prepare($userOrderUpdateSql);
                    $userOrderUpdateStmt->execute([$phone, $address, $recipient]);
                }
            }
        }
    }
    echo "資料庫更新成功<br>";

}catch(PDOException $e){
    echo "資料庫更新失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}


?>