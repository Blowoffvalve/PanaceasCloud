
<?php
  session_start();
                    $_SESSION['data'] = $_POST['query_string'];
                    require 'serverSettings.php';
                    if($_SESSION['wordpress'] && file_exists($PanaceaServer["wordpressInstall"].'wp-load.php')) {
	                    include_once($PanaceaServer["wordpressInstall"].'wp-load.php');
	                    if(!is_user_logged_in() || wp_get_current_user()->user_email!=$_SESSION['email']) {
		                    header("Location: logout.php");
	                    }
	                }
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="js/Chart.js"></script>

    <title>Supplies</title >
    
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
      <link href="css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      #label1{
        position: relative;
        top: auto;
        left:auto;
        height: auto;
        width: 110%;
        color: black;
        background-color: rgba(61, 255, 197, 1);
        text-align: center;
        font-weight: bold;

      }
      #label2{
        position: relative;
        top: auto;
        left:auto;
        height: auto;
        width: 110%;
        background-color:rgba(255, 0, 0, 1);
        text-align: center;
        font-weight: bold;
      }
    </style>


</head>

<body>

    <div id="wrapper">
        <?php
            require 'navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                  <div id = "title3">
        <h1>Supplies</h1>
      </div>
      
  <div class="modal-body">
          <div class="con">         
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th><span class="glyphicon glyphicon-stop"></span></th>
                  <th>Facility Name</th>
                  <th>Number of Blood Bags</th>
                  <th>Phone Number</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="glyphicon glyphicon-stop"></span></td>
                  <td>MU University Hospital</td>
                  <td>24</td>
                  <td>573-882-4141</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-stop"></span></td>
                  <td>Boone Hospital Center</td>
                  <td>37</td>
                  <td>555-815-8000</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-stop"></span></td>
                  <td>Mizzou Urgent Care</td>
                  <td>45</td>
                  <td>573-882-8920</td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
      
      </div>

 
  <div class = "row">
    <div style="width: 50%" class="col-lg-12">
      <div id = "label1">Max Amount</div>
      <div id = "label2">Current Level</div>
      <canvas id="canvas" height="450" width="600"></canvas>

    </div>
  </div>


  <script>
  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

  var barChartData = {
    labels : ["Normal Seline Solution","Gauze","Alcohol Preps","Aspirin","Narcan","Epi Pen","Adenosine"],
    datasets : [
      {
        fillColor : "rgba(61, 255, 197, 0.5)",
        strokeColor : "rgba(61, 255, 197, 0.8)",
        highlightFill: "rgba(61, 255, 197, .75)",
        highlightStroke: "rgba(61, 255, 197, 1)",
        data : [89,89,89,89,89,89,89]
      },
      {
        fillColor : "rgba(255, 0, 0, .5)",
        strokeColor : "rgba(255, 0, 0, 0.8)",
        highlightFill : "rgba(255, 0, 0, 0.75)",
        highlightStroke : "rgba(255, 0, 0, 1)",
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      }
    ]

  }
  window.onload = function(){
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
      responsive : true
    });
  }

  </script>
    </div>
  </div>
  
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>


</body>

  
</html>




