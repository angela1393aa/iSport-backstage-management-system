<?php
require_once('includes/config.php');

if(isset($_POST["id"])){
    $id=$_POST["id"];
}else{
    echo "請依正確方式傳遞";
    exit;
}

if($_POST["birthday"]=="0000-00-00 00:00:00"){
    $birthday=$birthday;
}else{
    $birthday=$_POST["birthday"];
}

$password=$_POST["password"];
$email=$_POST["email"];
$user_name=$_POST["user_name"];
$intro=$_POST["intro"];
$phone=$_POST["phone"];
$address=$_POST["address"];
// $birthday=$_POST["birthday"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);



$sql ="UPDATE users SET  password=?,email=?,user_name=?,intro=?,phone=?,address=?,birthday=? WHERE id=?";
$stmt = $db_host->prepare($sql);

try{
    $stmt->execute([$hashed_password,$email,$user_name,$intro,$phone,$address,$birthday,$id]);
    echo "修改資料成功";
}catch(PDOException $e){
    echo "修改資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

header('location: axios_user_list.php');

?>