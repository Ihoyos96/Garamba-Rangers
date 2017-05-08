<?php
ob_start();
session_start();
require('../connection.php');
ini_set('display_errors', 1); 

 //Garambaproject@gmail.com:universityofmiami
 //garambaproject:University1

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$dates = $_POST['date'];
$type = $_POST['type'];
$reporter = $_POST['reporter'];
$comment = $_POST['comment'];

mysqli_query($db, "INSERT INTO `garamba` (`id`,`latitude`,`longitude`,`type`,`date`,`reporter`,`comment`) VALUES 
                (NULL,'$latitude','$longitude','$type',STR_TO_DATE('$dates','%m/%d/%Y'),'$reporter','$comment')");
?>