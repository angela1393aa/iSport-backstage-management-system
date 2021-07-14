<?php
require_once('includes/config.php');


// $password=$_POST["password"];
// $email=$_POST["email"];
// $user_name=$_POST["user_name"];
// $intro=$_POST["intro"];
// $phone=$_POST["phone"];
// $address=$_POST["address"];
// $birthdate=$_POST["birthdate"];
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// $id = 22;
// $password=12345;
// $email=`test@test.com`;
// $user_name=`test123`;
// $intro=`test`;
// $phone=`test`;
// $address=`test`;
// $birthdate=`test`;
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// $sql="UPDATE users SET password=?,email=?,user_name=?,phone=?,address=?,birthday=?,intro=? WHERE id=?";
// $stmt = $db_host->prepare($sql);




$sql = "UPDATE users SET password = :password, 
            email = :email, 
            user_name = :user_name,  
            intro = :intro,  
            phone = :phone,
            address = :address,
            birthdate = :birthdate,
            WHERE id = :id";
$stmt = $db_host->prepare($sql);    

$stmt->bindParam(':id',$_POST["id"], PDO::PARAM_STR);       
$stmt->bindParam(':password', $_POST["password"], PDO::PARAM_STR);       
$stmt->bindParam(':email', $_POST["email"], PDO::PARAM_STR);    
$stmt->bindParam(':user_name', $_POST["user_name"], PDO::PARAM_STR);
// use PARAM_STR although a number  
$stmt->bindParam(':intro', $_POST["intro"], PDO::PARAM_STR); 
$stmt->bindParam(':phone', $_POST["phone"], PDO::PARAM_STR);   
$stmt->bindParam(':address', $_POST["address"], PDO::PARAM_INT);   
$stmt->bindParam(':birthdate', $_POST["birthdate"], PDO::PARAM_INT);   

// $stmt->execute(); 
try{
    $stmt->execute();
    // [$hashed_password, $email, $user_name, $phone, $address, $birthdate,$intro,$id]
    echo "修改資料成功";

}catch(PDOException $e){
    echo "修改資料失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}


?>