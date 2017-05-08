<?php
ob_start();
session_start();
require('../connection.php');
ini_set('display_errors', 1); 

function login($db){
ob_start();
if(isset($_POST['login'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  
  $sql = mysqli_query($db, "SELECT * FROM `garamba_users` WHERE `username` = '$username'");
  $arr = $sql->fetch_array(MYSQLI_ASSOC);

  if(password_verify($password, $arr['password'])){
    header("LOCATION: http://answrbook.com/csc431/index.php");
    $_SESSION['access'] = true;
    $_SESSION['permission_level'] = $arr['access'];
  }else{
    echo '<div class="alert alert-danger"> Access Denied</div>';
  }
 }
 
 }
?>
<!DOCTYPE html>
<html>
  <head>
  
  
  
  <script
  src="http://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  
  

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" 
href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" 
src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" 
src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>



    <style>
    html, body {
  min-height: 100%;
  min-width: 100%;
  padding: 0;
  margin: 0;
 
 
}

#full-screen-background-image {
  z-index: -999;
  min-height: 100%;
  min-width: 1024px;
  width: 100%;
  position:fixed;
  height: auto;
  
  top: 0;
  left: 0;
}

#wrapper {
  position: relative;
  width: 800px;
  min-height: 400px;
  margin: 100px auto;
  color: #333;
}



      
    </style>
  </head>
  
  
  <body style="">
  <div><img alt="full screen background image" src="https://africageographic.com/wp-content/uploads/2015/10/garamaba-elephants-african-parks.jpg" id="full-screen-background-image" /></div>
   <div class="row">
    <div class="col-sm-4">
    </div>
    
    <div class="col-sm-4"></br></br></br></br></br>
       <div class="panel panel-default">
         <div class="panel-heading">
          <strong> Login </strong>
         </div>
         
         <div class="panel-body">
         <form method="POST" action="http://answrbook.com/csc431/login.php">
            <input class="form-control" placeholder="Username" name="username"></br>
            <input class="form-control" placeholder="Password" type="password" name="password">
            </br>
            <input type="submit" value="Log In" class="btn btn-primary btn-block" name="login"> 
         </div>
         </form>
         <div class="panel-footer">
         </div>
       </div>
     
     <?php 
 login($db);
      ?>
     
    </div>
    
    <div class="col-sm-4">
    </div>
    
    
    
    </div>
    
    
   

  
  <body>
  
  
  
   
  
  
  
   
   


   
   
    

  

   
  
  
 
  

</html>