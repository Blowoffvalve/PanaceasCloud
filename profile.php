
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
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                            Profile
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Profile
                            </li>
                        </ol>
                    </div>
                </div>
               <div>

                </div>
                    <div class="location">
                        <label for="username">Username:</label>
                        <input type="name" class="form-control" id="username" placeholder="mdvy96">&nbsp;&nbsp;&nbsp;<button type="locate" class="btn btn-default">Reset Password...</button>&nbsp;&nbsp;&nbsp;<button type="locate" class="btn btn-default">Change security question...</button>
                      <form role="form">
                        <div class="form-group">
                          <label for="firstname">First Name:</label>
                          <input type="name" class="form-control" id="firstname" placeholder="Mark">
                          <label for+"lastname">Last Name:</label>
                          <input type="name" class="form-control" id="lastname" placeholder="Vassell">
                        </div>
                        <div class="form-group">
                          <label for="reportname">Organization:</label>
                          <input type="reportname" class="form-control" id="reportname" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="location1">Department:</label>
                          <input type="location1" class="form-control" id="location1" placeholder="123 Main Street">
                        </div>
                        <div class="form-group">
                          <label for="location2">Title:</label>
                          <input type="location2" class="form-control" id="location2" placeholder="">
                        </div>
                            Resource Type:
                            <select>
                                <option value="0">Internal</option>
                                <option value="1">External</option>
                            </select>
                            <select>
                                <option value="0">Job</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="address1">Address:</label>
                          <input type="name" class="form-control" id="address1" placeholder="123 Main Street Columbia, MO 65201">
                        </div>
                        <div>
                            <form class="form-inline" role="form">
                              <div class="form-group">
                                <label for="phone2">Phone:</label>&nbsp;&nbsp;&nbsp;<button type="locate" class="btn btn-default">add</button>
                                <input type="name" class="form-control" id="phone2" placeholder="555-555-5555">
                                <select>
                                    <option value="0">Home</option>
                                    <option value="1">Mobile</option>
                                    <option value="2">Business</option>
                                    <option value="3">Other</option>
                                </select>
                                <select>
                                    <option value="0">Do not notify</option>
                                    <option value="1">Notify first</option>
                                    <option value="2">Notify second</option>
                                    <option value="3">Notify third</option>
                                </select>
                                <button type="locate" class="btn btn-default">remove</button>
                              </div>
                              <div class="form-group">
                                <label for="email2">Email/Pager/Other:</label><label for="phone2">Phone:</label>&nbsp;&nbsp;&nbsp;<button type="locate" class="btn btn-default">add</button>
                                <input type="name" class="form-control" id="email2" placeholder="123@mail.com">
                                <select>
                                    <option value="0">Email</option>
                                    <option value="1">Pager</option>
                                    <option value="2">Radio</option>
                                    <option value="3">Direct Connect</option>
                                    <option value="4">Fax</option>
                                    <option value="5">Website</option>
                                    <option value="6">IM</option>
                                    <option value="7">Other</option>

                                </select>
                                <button type="locate" class="btn btn-default">remove</button>
                              </div>
                            </form>
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
