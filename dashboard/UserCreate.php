<?php
require_once("includes/config.php");

if(isset($_POST["account"])){
    $account=$_POST["account"];
}else{
    echo "請依正確方式傳遞";
    exit;
}

$sql="INSERT INTO users(account,password,email,user_name,create_time,phone,address,valid,birthday,intro)
    VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt=$db_host->prepare($sql);
    
$password=$_POST["password"];
$email=$_POST["email"];
$user_name=$_POST["user_name"];
$create_time=date('Y-m-d H:i:s');
$intro=$_POST["intro"];
$phone=$_POST["phone"];
$address=$_POST["address"];
$birthdate=$_POST["birthdate"];
$valid=1;
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


try{
    $stmt->execute([$account,$hashed_password, $email,$user_name,$create_time ,$phone,$address,$valid,$birthdate,$intro]);
    echo "新資料已建立";

}catch(PDOException $e){
    echo "資料庫新增失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

// $stmt->close();
header('location: axios_user_list.php');

    
    

?>