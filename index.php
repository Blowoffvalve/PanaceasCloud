<?php           
    session_start();
    //checking if the user is logged in 
    function check_session($username){
      foreach($_SESSION['log_users'] as $lu){
        if(($lu['users']==$username)){
          return 1;
        }
      }
    }
    if($_SESSION['status'] != 'true'){
        header("Location: login.php");
    }
    // if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    //     $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    //     header("Location: $redirect");
    // }
    require 'dbConnection.php';
    $sql = "SELECT * FROM admin Where email = '".$_SESSION['email']."'";
          $result = $db->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['fname']." ".$row['lname'];
            if(check_session($row['fname'].$row['lname']) != 1){
                  $_SESSION['log_users'][] = array('users'=>$row['fname'].$row['lname']);
            }
        }
    $db->close();
?>
<!DOCTYPE html>
<html lang="en" ng-app="panaceasCloudApp">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="favicon.ico">
    <style>
    .center{
        text-align: center;
    }
    </style>
    <title>Panacea's Cloud</title>
    
  <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
      

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!--<link href="css/plugins/morris.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.js" type="text/javascript" charset="utf-8"></script>
    <style>
      #map-canvas {
        width: 100%;
        height: 700px;
        margin-bottom: 10px;
      }
      #personFilter {
        z-index: 1001;
      }
    </style>

    
      <!--<script src='https://api.tiles.mapbox.com/mapbox.js/v2.3.0/mapbox.js'></script>
      <link href='https://api.tiles.mapbox.com/mapbox.js/v2.3.0/mapbox.css' rel='stylesheet' />-->
      <script src='https://api.mapbox.com/mapbox.js/v2.3.0/mapbox.js'></script>
      <link href='https://api.mapbox.com/mapbox.js/v2.3.0/mapbox.css' rel='stylesheet' /> 
      <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-label/v0.2.1/leaflet.label.js'></script>
      <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-label/v0.2.1/leaflet.label.css' rel='stylesheet'/>
      <!--
            <link href='css/mapbox.css' rel='stylesheet' />
            <script src='js/mapbox.js'></script>
        -->
    <script>
        L.mapbox.accessToken = 'pk.eyJ1IjoiZ2lsbGlzaiIsImEiOiJjaW1vemtma2swMG1pdWFtMTJvbnA1Y3E3In0.KwM853sp3V_3IokvcdpiKQ';
	//L.mapbox.accessToken = 'pk.eyJ1Ijoid2FuZ3MyNzE4IiwiYSI6IkliNFlxVnMifQ.neE8x-q88vUI78m_IU0l4w';
        // L.mapbox.accessToken = 'pk.eyJ1IjoiYnJpbGxpYW50YmVhbiIsImEiOiJjaWwzM2Zxd24zbTlidTlrc2p2cXZvMDZlIn0.-bwrbWe3UModN9QIt3GX5w';
        // L.mapbox.accessToken = 'pk.eyJ1IjoiaHIzOTk1NjA1MDAiLCJhIjoiY2lnaWc4d2p1MDAwMnU2a291d3h6OTA1NCJ9.E7vVd0WTO0u_lUa5oyeIyg';
    </script>
    <script type="text/javascript" src="js/oms.js"></script>
    <!-- angular js -->
     <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js"></script>
    
    <!-- selectize js -->
    <link rel="stylesheet" type="text/css" href="js/selectize/css/selectize.css"/>
    <script type="text/javascript" src="js/selectize/js/standalone/selectize.js"></script>
    <script type="text/javascript" src="js/selectize/angular-selectize.js"></script>


    <script type="text/javascript" src="js/util/hashmap.js"></script>
    <script type="text/javascript" src="js/util/util.js"></script>
    <script type="text/javascript" src="js/util/selectizeUtil.js"></script>
    <script type="text/javascript" src="js/map/manage_marker.js"></script>
    <script type="text/javascript" src="js/map/map_management.js"></script>
    <script type="text/javascript" src="js/index_patientModal/index_patientModal_controller.js"></script>

    <script type="text/javascript" src="js/angularjs/index_angular.js"></script>

   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body ng-controller="panaceasCloudController">

    <div id="wrapper">
        <?php
            require 'navigation.php';
        ?>


        <div id="page-wrapper">

            <div class="container-fluid">
               

                    <!-- Start map-->
                    <div class="col-lg-8">
                        <div class="row"> 
                             <p></p>
                        </div>
                      
                        
                        <?php
                          require 'edit_patient_modal.php';
                        ?>

                        <div class = "row">
                           <div id = "map-canvas"></div>
                        </div>

                    </div>

                    <!--END MAP-->


                    <div class="col-lg-4">
                        <div class="form-group" >
                            <label>Search Location</label></br>
                            <div class="form-group input-group">
                                <input type="text" class="form-control" id = "locationSearchBar" ng-model = "locationSearchBar" placeholder ="Search by location" ng-enter="searchLocation()">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" ng-click = "searchLocation()" ><i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>

                            <div style = "display:none;">
                                <label id = "incidentFilterLabel" >Filter Incident</label><br>
                                <select id="incidentFilter" ></select>
                            </div>
                            <div id= "staffFilterBar">
                                <label id = "staffFilterLabel">Filter Staff</label><br>
                                <select id="staffFilter" ></select>
                            </div>
                             <div id= "patientFilterBar">
                                <label id = "patientFilterLabel">Filter Patient</label><br>
                                <select id="patientFilter" ></select>
                            </div>

                            </br>
                            <label>Legend of Markers</label></br>
                            <div id="container">
                              <img src="./image/morgue_patient.png" style="width: 25px"/>
                              <label> MORGUE Patient</label>
                              </br>
                              <img src="./image/immediate_patient.png" style="width: 25px"/>
                              <label> IMMEDIATE Patient</label>
                              </br>
                              <img src="./image/delayed_patient.png" style="width: 25px"/>
                              <label> DELAYED Patient</label>
                              </br>
                              <img src="./image/minor_patient.png" style="width: 25px"/>
                              <label> MINOR Patient</label>
                              </br>
                              <img src="./image/staff.png" style="width: 25px"/>
                              <label> Staff</label>

                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->
                
  
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="notification fade" id="slide-bottom-popup" data-keyboard="false" data-backdrop="false">
           <!-- /.modal-body -->
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>

