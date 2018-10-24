
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
                    
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title >
    
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

    <!-- Custom Fonts -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
            require "navigation.php";

        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Facility Details
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Facilities
                            </li>
                        </ol>
                    </div>
                </div>
               <div>

                </div>
                    <div class="location">
                      <form role="form">
                        <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="name" class="form-control" id="name" placeholder="University Hospital">
                        </div>
                        <div class="form-group">
                          <label for="reportname">Report Name:</label>
                          <input type="reportname" class="form-control" id="reportname" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="location1">First Address Line:</label>
                          <input type="location1" class="form-control" id="location1" placeholder="123 Main Street">
                        </div>
                        <div class="form-group">
                          <label for="location2">Second Address Line:</label>
                          <input type="location2" class="form-control" id="location2" placeholder="second line">
                        </div>
                        <div class="form-group">
                          <label for="city">City:</label>
                          <input type="city" class="form-control" id="city" placeholder="Columbia">
                        </div>
                        <div>
                            <select>
                                <option value="0">Select A State</option>
                                <option value="1">AK</option>
                                <option value="2">AL</option>
                                <option value="3">AR</option>
                                <option value="4">AZ</option>
                                <option value="5">CA</option>
                                <option value="6">CO</option>
                                <option value="7">CT</option>
                                <option value="8">DE</option>
                                <option value="9">FL</option>
                                <option value="10">GA</option>
                                <option value="11">HI</option>
                                <option value="12">IA</option>
                                <option value="13">ID</option>
                                <option value="14">IL</option>
                                <option value="15">IN</option>
                                <option value="16">KS</option>
                                <option value="17">KY</option>
                                <option value="18">LA</option>
                                <option value="19">MA</option>
                                <option value="20">MD</option>
                                <option value="21">ME</option>
                                <option value="22">MI</option>
                                <option value="23">MN</option>
                                <option value="24">MO</option>
                                <option value="25">MS</option>
                                <option value="26">MT</option>
                                <option value="27">NC</option>
                                <option value="28">ND</option>
                                <option value="29">NE</option>
                                <option value="30">NH</option>
                                <option value="31">NJ</option>
                                <option value="32">NM</option>
                                <option value="33">NV</option>
                                <option value="34">NY</option>
                                <option value="35">OH</option>
                                <option value="36">OK</option>
                                <option value="37">OR</option>
                                <option value="38">PA</option>
                                <option value="39">RI</option>
                                <option value="40">SC</option>
                                <option value="41">SD</option>
                                <option value="42">TN</option>
                                <option value="43">TX</option>
                                <option value="44">UT</option>
                                <option value="45">VA</option>
                                <option value="46">VT</option>
                                <option value="47">WA</option>
                                <option value="48">WI</option>
                                <option value="49">WV</option>
                                <option value="50">WY</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="zip">Zip Code:</label>
                          <input type="zip" class="form-control" id="zip" placeholder="65201">
                        </div>
                        <div>

                            <form class="form-inline" role="form">
                              <div class="form-group">
                                <label for="lat">Latitude:</label>
                                <input type="lat" class="form-control" id="lat">
                              </div>
                              <div class="form-group">
                                <label for="long">Longitude:</label>
                                <input type="long" class="form-control" id="long">
                              </div>
                              <button type="locate" class="btn btn-default">Locate on Map</button>
                            </form>
                        </div>
                        <div class="form-group">
                          <label for="phone1">Phone Number:</label>
                          <input type="phone1" class="form-control" id="phone1" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="fax2">Fax:</label>
                          <input type="fax2" class="form-control" id="fax2" placeholder="">
                        </div>
                        <div>
                            <select>
                                <option value="0">Type</option>
                                <option value="1">Aeromedical</option>
                                <option value="2">Ambulance</option>
                                <option value="3">Assisted Living</option>
                                <option value="4">Clinic</option>
                                <option value="5">Community Health</option>
                                <option value="6">Dialysis</option>
                                <option value="7">Fire Department</option>
                                <option value="8">Heliport</option>
                                <option value="9">Hospice</option>
                                <option value="10">Hospital</option>
                                <option value="11">Hospital Ship</option>
                                <option value="12">Nursing Home</option>
                                <option value="13">Office Building</option>
                                <option value="14">Other</option>
                                <option value="15">Psych</option>
                                <option value="16">Rehab</option>
                                <option value="17">Shelter</option>
                                <option value="18">Skilled Nursing Facility</option>
                                <option value="19">Trailer</option>
                                <option value="20">Urgent Care</option>
                            </select>
                        </div>
                        <div>

                        </div>
                      </form>
                    </div>
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
