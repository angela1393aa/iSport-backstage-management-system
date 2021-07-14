<?php
require_once('../includes/config.php')
$id=$_POST["id"];
$stmt=$db_host->prepare("SELECT * FROM users WHERE id=?");



?>