
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
    

    <title>Add Patient</title >
    
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="../css/plugins/morris.css" rel="stylesheet">

      

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

      <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

      <script type="text/javascript" src="js/angularjs/add_patient_angular.js"></script>
  

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
    <style>
      th{
        text-align: center;
      }
      .red{
        color: red;
      }
      .yellow{
        color: orange;
      }
      .green{
        color: green;
      }
      .black{
        color: black;
      }
      .blue{
        color: blue;
      }
    </style>

</head>

<body ng-controller="PC_Add_Patient_Controller">

    <div id="wrapper">
        <?php
            require 'navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

              <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add Patient
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <span class="glyphicon glyphicon-plus"></span> Add Patient
                        </li>
                    </ol>
                  </div>
                </div>



                <div class="row">
                    <div class="col-md-12 col-sm-6 col-xs-12">
                      <div class="panel panel-primary">
                      
                        <div class="panel-body">
                          <form class="form-horizontal row-border" method = "POST" action="../patientlist_refresh.php">
                            <?php
                              // (isset($_POST["select_gender"])) ? $selectGender = $_POST["select_gender"] : $selectGender="Male";
                              //  (isset($_POST["select_status"])) ? $selectStatus = $_POST["select_status"] : $selectStatus="MINOR";
                               (isset($_POST["select_respirations"])) ? $selectRespirations = $_POST["select_respirations"] : $selectRespirations="None";
                                (isset($_POST["select_perfusion"])) ? $selectPerfusion = $_POST["select_perfusion"] : $selectPerfusion="None";
                                (isset($_POST["select_mentalStatus"])) ? $selectMentalStatus = $_POST["select_mentalStatus"] : $selectMentalStatus="None";
                            ?>
 
                            <div class='form-group'>

                              <label class='col-sm-2 control-label'>Incident ID:</label>
                                <div class='col-sm-3'>
                                  <p class='form-control-static'><?php echo $_POST['addPatient'];?></p>
                                </div>
                               <label class='col-sm-2 control-label'>Incident Name:</label>
                                <div class='col-sm-5'>
                                  <p class='form-control-static'>
                                    <?php 
                                      require 'dbConnection.php';
                                      $sql = "SELECT name FROM incidents where I_ID = '".$_POST['addPatient']."'";
                                      $result = $db->query($sql);
                                      if(count($result) != 0 ){
                                        foreach ($result as $row) {
                                          echo $row['name'];
                                        }
                                      }
                                    ?>
                                </p> 
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-2 control-label">First Name:</label>
                              <div class="col-sm-3">
                                <input class="form-control" type="input" name="addFirstName" placeholder="Patient's first name">
                              </div>
                              <label class="col-sm-2 control-label">Last Name:</label>
                              <div class="col-sm-3">
                                <input class="form-control" type="input" name="addLastName" placeholder="Patient's last name">
                              </div>
                            </div>
                            <div class = "form-group">
                              <label class="col-sm-2 control-label">Age:</label>
                              <div class="col-sm-3">
                                <input class="form-control" type="input" name="addAge" placeholder="Patient's age">
                              </div>
                              <label class="col-sm-2 control-label">Gender:</label>
                              <div class="col-sm-3">
                                <select class="form-control" id="select_gender" name="select_gender">
                                    <option selected="selected" value = "default">Select patient's gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Unspecified</option>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-2 control-label">Status:</label>
                              <div class="col-md-10">
                                <label class='radio-inline'>
                                  <input type='radio' name='select_status' ng-model = "select_status" <?php if ($selectStatus == "MORGUE" ) echo "checked ='true' "; ?> value='MORGUE'><font color = "black">MORGUE</font>
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='select_status' ng-model = "select_status" <?php if ($selectStatus == "IMMEDIATE" ) echo "checked ='true' "; ?> value='IMMEDIATE' ><font color = "red">IMMEDIATE</font>
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='select_status' ng-model = "select_status" <?php if ($selectStatus == "DELAYED" ) echo "checked ='true' "; ?> value='DELAYED'><font color = "orange">DELAYED</font>
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='select_status' ng-model = "select_status" <?php if ($selectStatus == "MINOR" ) echo "checked ='true' "; ?> value='MINOR'><font color = "green">MINOR</font>
                                </label>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-2 control-label"><font color = "red">IMMEDIATE</font>:</label>
                              <div class="col-md-10">
                                <label class='col-md-3 control-label'>Respirations</label>
                                  <label class='radio-inline'>
                                  <input type='radio' name='select_respirations' <?php if ($selectRespirations == "R" ) echo "checked ='true' "; ?> value='R'>Over 30 Seconds
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='select_respirations' <?php if ($selectRespirations == "None" ) echo "checked ='true' "; ?> value='None'>None
                                </label>
                              </div>
                              <label class="col-md-2 control-label"></label>
                              <div class="col-md-10">
                                <label class='col-md-3 control-label'>Perfusion</label>
                                  <label class='radio-inline'>
                                  <input type='radio' name='select_perfusion' <?php if ($selectPerfusion == "P" ) echo "checked ='true' "; ?> value='P'>Capillary Refill Over 2 Seconds
                                </label>
                                
                                <label class='radio-inline'>
                                  <input type='radio' name='select_perfusion' <?php if ($selectPerfusion == "None" ) echo "checked ='true' "; ?> value='None'>None
                                </label>
                              </div>
                               <label class="col-md-2 control-label"></label>
                              <div class="col-md-10">
                                <label class='col-md-3 control-label'>Mental_Status</label>
                                  <label class='radio-inline'>
                                  <input type='radio' name='select_mentalStatus' <?php if ($selectMentalStatus == "M" ) echo "checked ='true' "; ?> value='M'>Unable to Follow Simple Commands
                                </label>
                               
                                <label class='radio-inline'>
                                  <input type='radio' name='select_mentalStatus' <?php if ($selectMentalStatus == "None" ) echo "checked ='true' "; ?> value='None'>None
                                </label>
                              </div>
                              
                            </div>
                            <div class="form-group">
                              <label class="col-md-2 control-label">Patient Narrative:</label>
                              <div class="col-md-10">
                                <textarea class="form-control" rows = "3" name="addPatientCondition" placeholder="Input patient's narrative"></textarea>
                              </div>
                            </div>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Tracking Beacon:</label>
                              <div class="col-sm-5">
                               <!--  <input class="form-control" type="input" name="addBeacon" placeholder="Input patient's mobile phone number"> -->
                                  <select class="form-control" name="addBeacon"> 
                                     
                                      <?php 
                                      require 'dbConnection.php';
                                      $sql = "SELECT id FROM beacons where id NOT IN (SELECT Beacon_ID FROM patients WHERE Beacon_ID is not null)";
                                      $result = $db->query($sql);
                                      if(count($result) != 0 ){
                                        foreach ($result as $row) {
                                          echo "<option value =".$row['id'].">".$row['id']."</option>";
                                        }
                                      }
                                    ?>
                                  </select>
                              </div>
                            </div>
                        </div><!-- panel body-->
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary " name = "addBtn" value = "<?php echo $_POST['addPatient'];?> "><span class='glyphicon glyphicon-pencil'></span> Add</button>
                        <button type="reset" class="btn btn-primary " name = "resetBtn"><span class='glyphicon glyphicon-repeat'></span> Reset</button>
                    </div>
                  </div>
                  <!-- button-->

                </form>
              </div> <!-- end container-fluid -->
            </div>
          </div>
        </div><!-- /.row -->
      </div>
    </div>
  </div>
    

</body>

  
</html>
 