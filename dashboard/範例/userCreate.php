<?php
require_once("./config.php");
// if(isset($_POST["account"])){
//     $account=$_POST["account"];
// }else{
//     echo "沒有帶資料";
//     exit;
// }

$article_name = $_POST["article_name"];
$added_by = $_POST["added_by"];
$content = $_POST["content"];
$category = $_POST["category"];
$upload_date = date('Y-m-d H:i:s');//取得目前時間

date_default_timezone_set("Asia/Taipei");//時區

$sql="INSERT INTO article (article_name, added_by, upload_date, content, category) VALUES (?,?,?,?,?)";//這裡要改
$stmt=$db_host->prepare($sql);
//建立資料表命名方式用底線的

try{
    $stmt->execute([$article_name, $added_by, $upload_date, $content, $category]);
    echo "新增資料成功";

}catch(PDOException $e){
    echo "新增資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

// $db_host->close();

header('location: user-list.php');
?>