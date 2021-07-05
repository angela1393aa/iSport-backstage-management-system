<?php
ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "mfee17_4_db";

date_default_timezone_set("Asia/Taipei");
session_start();

try{
    $db_host= new PDO(
        "mysql:host={$servername}; dbname={$dbname};charset=utf8",
        $username, $password
    );
}catch (PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}
// echo "資料庫連結成功";

// $db_host=null;
?>