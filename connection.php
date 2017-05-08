<?php
  $dbServername = "server1.answrbook.com"; 
  $dbHostname ="localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "answrboo_theBook";
  $db = new mysqli($dbHostname,$dbUsername, $dbPassword, $dbName);
  //Error Detection if cannot connect to the database for some reason.
  if($db->connect_error){
    die("Error connecting to the database." . $db->connect_error);
  }
?>