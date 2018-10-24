
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
    

    <title>Staff</title >
    
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
   
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      
      <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
         <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script> 
       <script> 
          $(function(){ 
              $("#dateInput").datetimepicker({
                 format: 'yyyy-mm-dd hh:ii',
                 startDate: '-3d'
            }
                  
                ); 
          }); 
        </script> 

         
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      th{
        text-align: center;
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

              <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Create Incident
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <span class="glyphicon glyphicon-plus"></span> Create Incident
                            </li>
                        </ol>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12 col-sm-6 col-xs-12">
                      <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                          <i class="icon-calendar"></i>
                          <h3 class="panel-title">Edit Incident</h3>
                        </div>
                       
                        <div class="panel-body">
                          <form class="form-horizontal row-border" method = "POST" action="./incidentlist_refresh.php">
                            <?php
                              (isset($_POST["select_type"])) ? $selectType = $_POST["select_type"] : $selectType="Real Incident";
                              //print $_POST["incidentYear"];
                            ?>
                            <div class="form-group">
                              <label class="col-md-2 control-label">Type:</label>
                              <div class="col-md-10">
                                <label class='radio-inline'>
                                  <input type='radio' name='select_type' <?php if ($selectType == "Real Incident" ) echo "checked ='true' "; ?> value='Real Incident'>Real Incident
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='select_type' <?php if ($selectType == "Exercise/Drill" ) echo "checked ='true' "; ?> value='Exercise/Drill'>Exercise/Drill
                                </label>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-2 control-label">Name:</label>
                              <div class="col-md-10">
                                <input class="form-control" type="input" name="createName" placeholder="Input incident's name">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-2 control-label">Description:</label>
                              <div class="col-md-10">
                                <textarea class="form-control" rows = "2" name="createDescription" placeholder="Input incident's description"></textarea>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-2 control-label">Mission Statement:</label>
                              <div class="col-md-10">
                                <textarea class="form-control" rows = "3" name="createMissionStatement" placeholder="Input incident's mission statement"></textarea>
                              </div>
                            </div>
                            
                            <?php
                              (isset($_POST["select_status"])) ? $selectStatus = $_POST["select_status"] : $selectStatus="Waiting";
                            ?>
                            <div class="form-group">
                              <label class="col-md-2 control-label">Status:</label>
                              <div class="col-md-10">
                                <label class='radio-inline'>
                                  <input type='radio' name='select_status' <?php if ($selectStatus == "Waiting" ) echo "checked ='true' "; ?> value='Waiting'>Waiting
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='select_status' <?php if ($selectStatus == "Running" ) echo "checked ='true' "; ?> value='Running'>Running
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='select_status' <?php if ($selectStatus == "Completed" ) echo "checked ='true' "; ?> value='Completed'>Completed
                                </label>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-2 control-label">Incident Time:</label>
                              <div class="col-md-10">

                                <div class="input-group date col-md-5" id = "datepick" >
                                    <label class="input-group-btn" for="date-fld">
                                        <span class="btn btn-default" id = "dateBtn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>

                                    </label>
                                    <input type="text" id = "dateInput" class="form-control date-input" value = "<?php date_default_timezone_set('America/Chicago'); $date = date('Y-m-d H:i:s'); echo $date;?> " name="createTime">
                                </div>
                    
                                </div>
                              </div>
                           
                            

                          
                        </div><!-- panel body-->
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary " name = "createBtn"><span class='glyphicon glyphicon-pencil'></span> Create</button>
                        <button type="reset" class="btn btn-primary " name = "resetBtn"><span class='glyphicon glyphicon-repeat'></span> Reset</button>
                    </div>
                </div>

                </form>
            </div> <!-- end container-fluid -->
        </div>
</div>



    

</body>

  
</html>
 