<?php
ob_start();
session_start();
require('../connection.php');
ini_set('display_errors', 1); 

 //Garambaproject@gmail.com:universityofmiami
 //garambaproject:University1




get_nasa_data($db);

function update_day($db){
  $today = get_today('z');
  $sql = mysqli_query($db, "UPDATE `garamba_info` SET `day`='$today' WHERE `id` = 1");
}



function getPastDate($days) {
    return date('m/d/Y', time() - 86400 * $days);
   }


function get_nasa_data($db){
  $today = get_today('z');
  $last = last_day($db);
  if($lastday == NULL || $today != $lastday) {
    //Download nasa data and parse, etc
      update_day($db);
      $ftp_server = "198.118.194.202";
      $ftp_user = "garambaproject";
      $ftp_pass = "University1";

      // set up a connection or die
      $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

//-----------------------
      $i = $last + 1;
      $year = date("Y");

        // try to login
        if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
         // echo "Connected as $ftp_user@$ftp_server\n";
       
          ftp_pasv($conn_id, true);
          ftp_chdir($conn_id, './FIRMS/c6/Northern_and_Central_Africa/');
          while($i < $today) {
          $target = fopen('./abc.csv', 'w');
          //ftp_fget($conn_id, $target, './MODIS_C6_Northern_and_Central_Africa_MCD14DL_NRT_2017127.txt',FTP_ASCII);
          $spacer = '';
          if($i < 100){
            $spacer = $i < 10 ? "00" : "0";
          }
          ftp_fget($conn_id, $target, './MODIS_C6_Northern_and_Central_Africa_MCD14DL_NRT_'.$year.''.$spacer.''.$i.'.txt',FTP_ASCII);   
          fclose($target);
          if(($handle = fopen("./abc.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $lat = $data[0];
                $long = $data[1];
                $type = "WildFire";
                $dates = $data[5];
                $reporter = "NASA";
                $comment = "N/A";
              if($lat < 5 && $lat > 3.5 && $long < 32 && $long > 28) {
                mysqli_query($db, "INSERT INTO `garamba` (`id`,`latitude`,`longitude`,`type`,`date`,`reporter`,`comment`) VALUES 
                (NULL,'$lat','$long','$type',STR_TO_DATE('$dates','%Y-%m-%d'),'$reporter','$comment')");
              }  
              
            }
            fclose($handle);
          }
          echo '</br>';
          $i++;
        }
        } else {
        echo "Couldn't connect as $ftp_user\n";
        echo $i;
        }
    // close the connection
    ftp_close($conn_id);
  }//First IF
}//EOF



function store_today($db){
  $day = get_today('z');
  mysqli_query($db,"INSERT INTO `garamba_info` (`id`, `day`) VALUES (NULL, '$day')");
}

function get_today($flag){
  return $flag == 'z' ? date($flag) + 1 : date($flag);
}

function last_day($db){
 $result = mysqli_query($db,"SELECT * FROM `garamba_info` WHERE `id` = 1");
 return $result->fetch_array()['day'];
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

<script>

</script>

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
        width: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
  
<nav class="navbar navbar-inverse" style="padding-bottom:0; margin-bottom:0;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="color:white;">Garamba Ranger Support System</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown">
       
       
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
     
    
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span style="color: white;"><span class="glyphicon glyphicon-user"></span> Access Level:</span> <span class="text-danger"><strong>Administrator</strong></span></a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>

<form class="navbar-form navbar-left" action="http://answrbook.com/csc431/index.php" method="POST">
  
     <input class="form-control" name="start_window" placeholder="Start day"  value="<?php echo getPastDate(7); ?>">
     <input class="form-control" name="end_window" placeholder="End day" value="<?php echo get_today('m/d/Y'); ?>">
     <button class="btn btn-success" name="animate">Animate </button>
     <button class="btn btn-warning" name="plot">Plot</button>
</form>

<?php

   if(isset($_POST['plot']) || isset($_POST['animate'])) {
      $start = mysqli_real_escape_string($db,$_POST['start_window']);
      $end= mysqli_real_escape_string($db, $_POST['end_window']);

      $flag = isset($_POST['plot']) ? "plot" : "animate";


     $sql = $db->query("SELECT * FROM `garamba` WHERE (`date` BETWEEN STR_TO_DATE('$start','%m/%d/%Y') AND STR_TO_DATE('$end','%m/%d/%Y')) ORDER BY `id` DESC");
      

     while($result = $sql->fetch_array(MYSQLI_ASSOC)){
       $latitude = $result['latitude'];
       $longitude = $result['longitude'];
       $comment = $result['comment'];
       $issueReported = $result['type'];
       $dateOccured = $result['date'];
       $reporter = $result['reporter'];
       $type = $result['type'];
       $dbMapData .= "$latitude,$longitude,$type,$dateOccured,$reporter,$comment(@)";
     }
     
   }



?>



  </div>
</nav>
  
  <body>
  
  
  
    <div id="map"></div>
    
    <ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#home">Input Reported Data</a></li>
  <li><a data-toggle="pill" href="#menu1">View Nasa Data</a></li>
  <li><a data-toggle="pill" href="#menu2">Emergency Queue</a></li>
</ul>

<div class="tab-content">



  <div id="home" class="tab-pane fade in active">
  
  <div class="row">
  <div class="col-sm-4">
   <div class="form-group">
  <label for="usr">Time Occured</label>
  <input class="form-control" placeholder="eg. 12:05" type="text" id="timeO">
</div>
  <div class="form-group">
  <label for="usr">Reporter:</label>
  <input class="form-control" placeholder="eg. Name of Ranger" type="text" id="reporter">
</div>
<label>Date Event Occured:</label>
<div class="input-group date" data-provide="datepicker">
    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="dateOccured">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
 
  <div align="center">
</br>
<button class="btn btn-primary" data-toggle="modal" data-target="#popupx"> <span class="glyphicon glyphicon-eye-open"></span> View Reports</button>
<button class="btn btn-danger"> <span class="glyphicon glyphicon-pencil"></span> Edit Reports</button>
</div>
  </div>
  
  <div class="col-sm-4">
  <label>Issue Reported:</label>
<select class="selectpicker form-control" id="issueReported">
  <option>Animal Carcass</option>
  <option>WildFire</option>
  <option>Signs of Poaching</option>
</select>
  <div class="form-group">
  <label for="usr">Latitude:</label>
  <input class="form-control" placeholder="eg. 2.099" type="text" id="latitude">
</div>
<label for="comment">Longitude:</label>
<input class="form-control" placeholder="eg. 117.09789" type="text" id="longitude">
<div id="succmsg" class=""> </div>

   
  </div>
  
  <div class="col-sm-4">
 
    <div class="form-group">
    
  <label for="comment">Comments <span class="text-danger">(Optional)<span></label>
  <textarea class="form-control" rows="5" id="comments"></textarea></br>
  
  <button class="btn btn-success btn-block" onclick="getInfo();"> Submit <span class="glyphicon glyphico-check"></span> </button>
</div>

 
  </div>
  


</div>
  </div>
 
  
  
  <div id="menu1" class="tab-pane fade">
   <div class="table-responsive">
    <table id="myTable" class="table table-striped">  
        <thead>  
          <tr>  
            <th>TBD</th>  
            <th>TBD</th>  
            <th>TBD</th>  
            <th>TBD</th>  
          </tr>  
        </thead>  
        <tbody>  
       
        
        
          <tr class="info">  
            <td>001</td>  
            <td>Flooding</td>  
            <td>Mild</td>  
            <td>10000</td>  
          </tr>  
          <tr class="danger">  
            <td>002</td>  
            <td>WildFire</td>  
            <td>Severe</td>  
            <td>28000</td>  
          </tr>  
          <tr class="success">  
            <td>003</td>  
            <td>Poaching</td>  
            <td>N/A</td>  
            <td>7000</td>  
          </tr>  
           <tr class="warning">  
            <td>0
            
           </td>  
            <td>Carcass Found</td>  
            <td>N/A</td>  
            <td>18000</td>  
          </tr>  
          <tr class="active">  
            <td>005</td>  
            <td>Reported Disturbance</td>  
            <td>N/A</td>  
            <td>12000</td>  
          </tr>  
         
          
           
        </tbody>  
      </table>  
      </div>
  </div>
   <div id="menu2" class="tab-pane fade">
</br>
    <div class="alert alert-success">No Unresponded to Emergencies!</div>
  </div>
  
</div>
    
    
    <script>
      var map;
      var markers = [];
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 9,
          center: {lat: 4, lng: 29.25},
          mapTypeId: 'terrain'
        });
        var script = document.createElement('script');
        document.getElementsByTagName('head')[0].appendChild(script);
      
      }




     $(document).ready(function(){
     $('#myTable').dataTable();
     $('#myTable2').dataTable();
     
     var mapdata= "<?php echo $dbMapData; ?>";
     var flag = "<?php echo $flag;?>";

     if(typeof mapdata!== 'undefined')
        pullMapData(flag);
  
        
    
    });
    
    
    
    
   //We want to call this function maybe every 30 secs to update database if internet goes out.
   function update(){
    
   }
  function deleteEntry(id){
    $('#delete' + id).fadeOut();
    
    var varData = "&id=" + id + '&action=' + "delete";
    
     $.ajax({
       type:"POST",
       url: "./action.php",
       data: varData,
       success: function(){
       console.log("Success!");
         }
        
    
       
       });
    
  }
     
     
  function pullMapData(flag){
         var coordinatesAsString = '<?php echo $dbMapData;?>';
         if(flag == 'plot') {
         var input = coordinatesAsString.split("(@)");
         
         for (x in input) {
          var arr = input[x].split(",");
          console.log(arr);
          var numberLatitude = parseFloat(arr[0]);
          var numberLongitude = parseFloat(arr[1]);
          var issueReported = arr[2];
          var dateOccured = arr[3];
          var reporter = arr[4];
          var comments = arr[5];
          
          var markerToPlot = {};
          markerToPlot.latitude = numberLatitude;
          markerToPlot.longitude = numberLongitude;
          markerToPlot.type = issueReported;
          markerToPlot.date = dateOccured;
          markerToPlot.reporter = reporter;
          markerToPlot.comment = comments;
          console.log(markerToPlot);
          customMarker(markerToPlot, map);
          }
          } else {
            
         var input = coordinatesAsString.split("(@)");
         
         for (x in input) {
          var arr = input[x].split(",");
          console.log(arr);
          var numberLatitude = parseFloat(arr[0]);
          var numberLongitude = parseFloat(arr[1]);
          var issueReported = arr[2];
          var dateOccured = arr[3];
          var reporter = arr[4];
          var comments = arr[5];
          
          var markerToPlot = {};
          markerToPlot.latitude = numberLatitude;
          markerToPlot.longitude = numberLongitude;
          markerToPlot.type = issueReported;
          markerToPlot.date = dateOccured;
          markerToPlot.reporter = reporter;
          markerToPlot.comment = comments;
          console.log(markerToPlot);
          markers.push(new customMarker(markerToPlot, null));

          }
          alert(markers);
          if (markers[0] != null) {
            animate(markers);
          }
          }

          
  }
  
  function animate(markers){
    
    for (var i = 0; i < markers.length; i++) {
       animatedPlot(markers[i], i * 500);
    }
  }

   function animatedPlot(mark, timeout) {
     window.setTimeout(function() {
       mark.marker.setMap(map);
     }, timeout);
     
   }


   function getDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
      dd='0'+dd
     }
     
    if(mm<10) {
      mm='0'+mm
    } 

    today = mm+'/'+dd+'/'+yyyy;
    return today;
   }
  
  function showReports(){
    //.load from php page
  }
  
  
   function getInfo(){
    var comments = $('#comments').val();
    var longitude = $('#longitude').val();
    var latitude = $('#latitude').val();
    var issueReported = $('#issueReported').val();
    var timeOccured = $('#timeO').val();
    var reporter = $('#reporter').val();
    var dateOccured = $('#dateOccured').val();

    
    var numberLongitude = parseFloat(longitude);
    var numberLatitude = parseFloat(latitude);

    if(!isNaN(numberLatitude) && !isNaN(numberLongitude)) {
      if(numberLatitude >= -90 && numberLatitude <= 90 && numberLongitude >= -180 && numberLongitude <= 180) {
        

        var varData = "&latitude=" + latitude + '&longitude=' + longitude + "&type=" + issueReported + "&date=" + dateOccured + '&reporter=' + reporter + '&comment=' + comments;
         $.ajax({
       type:"POST",
       url: "./submit.php",
       data: varData,
       success: function(){
         console.log("Success!");
         $("#succmsg").html('</br><p class="alert alert-success" id="success-alert">Submit Successful</p>');
         $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
         $("#success-alert").fadeOut(500);
         });
       }
       
       });

        var markerToPlot = {};
          markerToPlot.latitude = numberLatitude;
          markerToPlot.longitude = numberLongitude;
          markerToPlot.type = issueReported;
          markerToPlot.time = timeOccured;
          markerToPlot.date = dateOccured;
          markerToPlot.reporter = reporter;
          markerToPlot.comment = comments;

          customMarker(markerToPlot, map);
          
         
          
      }
      else {
        console.log("Please enter a valid number");
      }
    }
    else {
      console.log("please enter a number");
    }

   }
   
   
    </script>
<script type="text/javascript">
      var icon = [];
      icon["WildFire"] = "http://cdn.jsdelivr.net/emojione/assets/png/1F525.png";
      icon["Animal Carcass"] = "http://icons.iconarchive.com/icons/martin-berube/flat-animal/64/cardinal-icon.png";
      icon["Signs of Poaching"] = "http://icons.iconarchive.com/icons/martin-berube/flat-animal/64/frog-icon.png";
      icon["shark"] = "http://icons.iconarchive.com/icons/martin-berube/flat-animal/64/shark-icon.png";

      function customMarker(markerPrimitive, map) {
          var image = icon[markerPrimitive.type];
          var latLng = new google.maps.LatLng(markerPrimitive.latitude, markerPrimitive.longitude);
          var date = markerPrimitive.date;
          var marker = new google.maps.Marker({
              position: latLng,
              map: map,
              icon: image
            });
          var contentString = "<p>" + 
                                "Date: " + markerPrimitive.date+ "<br />" +
                                "Type: " + markerPrimitive.type + "<br />" +
                                "Reporter: " + markerPrimitive.reporter + "<br />" +
                                "Comments: " + markerPrimitive.comment + 
                              "</p>";
          var infowindow = new google.maps.InfoWindow({
            content: contentString
          });
          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });        
          this.marker = marker
        }
    </script>


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAa1MN5oSsprXw_Z2vpvcRrbnAEDvrS8PA&callback=initMap">
    </script>
   
    
  </body>
  
  

   <div class="modal fade" id="popupx">
<div class="modal-dialog modal-lg"> 
<div class="modal-content">
   <div class="modal-header"> 
<button type="button" class="close" data-dismiss="modal"> &times; </button>
   <h3 class="modal-title">Garamba Reports </h3>
</div>
   <div class="modal-body">
     <div id="report">
      <div class="table-responsive">
    <table id="myTable2" class="table table-striped">  
        <thead>  
          <tr>  
            <th>Action</th>  
            <th>Type</th>  
            <th>Latitude</th>  
            <th>Longitude</th>  
          </tr>  
        </thead>  
        <tbody>  
          <?php
          $a = $db->query("SELECT * FROM `garamba` ORDER BY `id` DESC");
          
           while($results = $a->fetch_array(MYSQLI_ASSOC)){
           
             $type = $results['type'];
             $long = $results['longitude'];
             $lat = $results['latitude'];
             $id = $results['id'];
             
             switch($type){
               case 'WildFire': $class = "danger";
               break;
                
               case 'Signs of Poaching': $class = "success";
               break;
               
               case 'Animal Carcass' : $class = "primary";
               break;
               
               default: $class = "warning";
             
             }
             
             echo  '
              <tr class='.$class.' id="delete'.$id.'">  
                <td>
                <button class="btn btn-xs btn-danger" onclick="deleteEntry('.$id.');"><span class= "glyphicon glyphicon-remove"></span></button>
                <button class="btn btn-xs btn-primary" id=edit'.$id.'"><span class= "glyphicon glyphicon-edit"></span></button>
                  <button class="btn btn-xs btn-success" id=view'.$id.'"><span class= "glyphicon glyphicon-eye-open"></span></button>
                 <!--  <a href="https://firms.modaps.eosdis.nasa.gov/active_fire/text/Russia_and_Asia_7d.csv"> Test Download</a> -->
                 <a href="https://firms.modaps.eosdis.nasa.gov/active_fire/c6/text/MODIS_C6_Northern_and_Central_Africa_24h.csv"> Test Download </a>
                </td>  
                <td><strong>'.$type.'</strong></td>  
               <td><strong>'.$long.'</strong></td>  
               <td><strong>'.$lat.'</strong></td>  
              </tr> 
             
                   ';
           }
          
          ?>
        
         
          
           
        </tbody>  
      </table>  
      </div>
  </div>
     </div>
 </div>
 <div class="modal-footer">
   
 </div>
 

</div> <!-- END OF MODAL    -->
  
  
 
  

</html>