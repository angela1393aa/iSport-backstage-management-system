<?php
require_once("includes/config.php");
$count = $db_host->prepare("SELECT * FROM users WHERE valid='1'");   
$count->execute();   
$no=$count->rowCount();

?>