<?php
$pdo=new PDO('mysql:host=localhost;dbname=assignment1;charset=utf8','root','');  // to connect with database
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>