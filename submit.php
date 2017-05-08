<?php
ob_start();
session_start();
require('../connection.php');
ini_set('display_errors', 1); 

 //Garambaproject@gmail.com:universityofmiami
 //garambaproject:University1
 
 function is_connected(){
    $connected = @fsockopen("www.google.com", 80); 
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$dates = $_POST['date'];
$type = $_POST['type'];
$reporter = $_POST['reporter'];
$comment = $_POST['comment'];

for($_POST as $post) $string .= "$post,";

if(is_connected()){
  mysqli_query($db, "INSERT INTO `garamba` (`id`,`latitude`,`longitude`,`type`,`date`,`reporter`,`comment`) VALUES 
                (NULL,'$latitude','$longitude','$type',STR_TO_DATE('$dates','%m/%d/%Y'),'$reporter','$comment')");
  }else{
   
     $file = fopen("backup.txt","w")  or die("Unable to open file!");
     fwrite($file,$string);
     fclose($file);
   
   
  }
?>