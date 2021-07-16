<?php
require_once("includes/config.php");
require_once("UserCount.php"); 


if(!isset($_GET["p"])){
    $p=1;
}else{
    $p=$_GET["p"];
}
$sql="SELECT * FROM users WHERE valid=1 LIMIT $star_item,$per_page";

$per_page=9;
$star_item=($p-1)*$per_page;
$sql="SELECT * FROM users WHERE valid=1 LIMIT 6";
$sth=$db_host->prepare($sql);
$sth->execute();   
$rows=$sth->fetchAll(PDO::FETCH_ASSOC);
$total=$count->rowCount();

$sqlTotle="SELECT * FROM users";
$resultTotal=$count->rowCount();
$pages=ceil($resultTotal/$per_page); //ceil無條件進位

// foreach($rows as $row){
//     foreach($row as $key=>$value){
//         echo $key.":".$value."<br/>";
//     }
// }
$db_host=null;
?>