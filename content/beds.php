<?php           
    session_start();         
                    //checking if the user is logged in 
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
                        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        header("Location: $redirect");
                    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Panacea's Glass" content="">
    <meta name="Mark Vassell and Olivia Apperson" content="">

    <title>Add Incidents Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="../css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="http://code.jquery.com/jquery.latest.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
        <h1>Beds</h1>
      </div>
      
  <div class="modal-body">
          <div class="con">         
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th><span class="glyphicon glyphicon-stop"></span></th>
                  <th>Facility Name</th>
                  <th>Number of Beds</th>
                  <th>Phone Number</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="glyphicon glyphicon-stop"></span></td>
                  <td>University Hospital Building A</td>
                  <td>22</td>
                  <td>555-555-55555</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-stop"></span></td>
                  <td>University Hospital Building B</td>
                  <td>43</td>
                  <td>555-555-55555</td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-stop"></span></td>
                  <td>University Hospital Building C</td>
                  <td>12</td>
                  <td>555-555-55555</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
        
      </div>
      
    </div>
  </div>
  
  <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
                <!-- /.row -->




</body>

  
</html>




