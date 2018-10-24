
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
    

    <title>View Patients</title >
    
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
      <script src="https://code.jquery.com/jquery-latest.min.js"></script>

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

<body>

    <div id="wrapper">
        <?php
            require 'navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
        <div id = "title3">
        <h1>View Patients</h1>
        <ol class="breadcrumb">
            <li>
            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
            <span class='glyphicon glyphicon-eye-open'></span> View Patients
            </li>
        </ol>
      </div>
      
  <div class="modal-body">
    <div class="row">
          <!-- <div class="col-md-12 col-sm-10 col-xs-12"> -->
            <div class="panel panel-primary">
                <div class="panel-body">
                  <?php (isset($_POST["search_by"])) ? $query = $_POST["search_by"] : $query='status';?>
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                      <div class='form-group'>
                      <label class="col-md-2 control-label">Search by:</label>
                          <div class="col-md-12">
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'P_ID' ) echo "checked ='true' "; ?> value='P_ID'>Patient ID
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'I_ID' ) echo "checked ='true' "; ?> value='I_ID'>Incident ID
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'incidentName' ) echo "checked ='true' "; ?> value='incidentName'>Incident Name
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'pName' ) echo "checked ='true' "; ?> value='pName'>Patient Name
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'status' ) echo "checked ='true' "; ?> value='status'>Status
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'statusImmediate' ) echo "checked ='true' "; ?> value='statusImmediate'>IMMEDIATE
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'pCondition' ) echo "checked ='true' "; ?> value='pCondition'>Patient Condition
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'age' ) echo "checked ='true' "; ?> value='age'>Age
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'gender' ) echo "checked ='true' "; ?> value='gender'>Gender
                                </label>

                           </div>
                         </div>
                        
                        

                        <div class='form-group'>
                        <label class="col-md-2 control-label">Key Words:</label>
                          <div class="col-md-12">
                                <input type="text" name="query_string" class = "form-control" placeholder = 'You can input some key words to search here' value='<?php echo $_SESSION['data'];?>' ></br>
                           </div>
                           
                        </div>
                        <div class='form-group'>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-info" name="submit">
                                    <span class="glyphicon glyphicon-search"></span> Search
                                </button>
                           </div>
                         </div>
                  </form>
                </div><!-- panel body-->
            </div>
          <!-- </div> -->
        </div><!-- row-->

        <div class = "row">
          <div class="con">         
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Edit</th>
                  <th>Remove</th>
                  <th>P_ID</th>
                  <th>I_ID</th>
                  <th>Incident Name</th>
                  <th>Patient Name</th>
                  <th>Status</th>
                  <th><a href="#" class = "tooltip-show" data-toggle="tooltip" data-placement="top" 
                  title="Respirations: Yes or No;  Perfusion: +2 Sec or -2 Sec; Mental Status: Can Do or Can't do">IMMEDIATE</th>
                  <th>Patient Condition</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  
                </tr>
              </thead>
              <script>$(function () { $('.tooltip-show').tooltip('toggle');});</script>
              
            <tbody>
                <?php
                  require 'dbConnection.php';
                  $type = htmlspecialchars($_POST['search_by']);
                  $query_string = htmlspecialchars($_POST['query_string']);
                  $query_string = '%'.$query_string. '%';

                  switch ($type) {
                      case "P_ID":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patients.";
                          }
                          break;
                      case "I_ID":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      case "incidentName":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      case "pName":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient;  
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      case "status":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      case "statusImmediate":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                               $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      case "pCondition":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      case "age":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      case "gender":
                          $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                            }
                          }else{
                            print "There is no patient.";
                          }
                          break;
                      default:
                          $sql = "SELECT * FROM patients ORDER BY P_ID DESC";
                          $result = $db->query($sql);
                  
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                
                                //$buttonId = $row['I_ID'];
                                
                                //$form = "<form method= 'POST' id = 'patientForm' name = 'patientForm' > ";
                                $viewPatient = ""; 
                                $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span> Edit</button></td>";
                                $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span> Remove</button></td>";
                                if ($row['status'] == 'MINOR'){
                                  $color = 'green';
                                  //print "yes";
                                }else if ($row['status'] == 'DELAYED'){
                                  $color = 'yellow';
                                }else if ($row['status'] == 'IMMEDIATE'){
                                  $color = 'red';
                                }else if ($row['status'] == 'MORGUE'){
                                  $color = 'black';
                                }else{
                                  $color = 'blue';
                                }

                                $viewPatient .= "<td>".$row['P_ID']."</td><td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['pName']."</td><td class = '" .$color. "'>".$row['status']."</td><td width = '100px'>".$row['statusImmediate']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$row['mobile']."</td><td>".$row['address']."</td><td>".$row['comments']."</td></tr>";
                                echo $viewPatient; 
                                //echo $viewpatient;    
                                //echo $editpatient; 
                                //print "</br>" . "id = " . $_POST["edit"];
                            }
                            }else{
                              print "There is no patient.";
                            }

                  }
                  
                  
                 
                ?>
    
                
                </tbody>

            </table>
              
            
          </div>
        </div>
        <!-- start Modal -->
          <!-- 模态框（Modal） -->
             

           </div>
      </div>
      
    </div>
  </div>
    <!-- Modal -->
    <?php
      require 'dbConnection.php';
      $sql = "SELECT * FROM patients ORDER BY P_ID DESC";
      $result = $db->query($sql);

      if(count($result) != 0 ){
          foreach ($result as $row) {
            //(isset($_POST["select_by"])) ? $query = $_POST["select_by"] : $query='Status';
            $editPatient = "<div class='modal fade' id='editP_".$row['P_ID']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                        &times;
                                  </button>
                                  <h4 class='modal-title' id='myModalLabel'>
                                     Edit Selected Patient
                                  </h4>
                               </div>
                            <div class='modal-body'>
                                
                                      <form class='form-horizontal' role='form' method = 'POST' action = 'patientlist_refresh.php' id = 'patientForm' name = 'patientForm'>
                                        <div class='form-group'>
                                         <label class='col-sm-2 control-label'>P_ID:</label>
                                              <div class='col-sm-2'>
                                                  <p class='form-control-static'>".$row['P_ID']."</p>
                                              </div>
                                          <label class='col-sm-2 control-label'>I_ID:</label>
                                              <div class='col-sm-2'>
                                                  <p class='form-control-static'>".$row['I_ID']."</p>
                                              </div>
                                            </div>

                                        <div class='form-group'>
                                         <label class='col-sm-2 control-label'>Incident Name:</label>
                                              <div class='col-sm-3'>
                                                  <p class='form-control-static'>".$row['incidentName']."</p>
                                              </div>
                                              <label for='inputFirstName' class='col-sm-2 control-label'>Patient Name:</label>
                                            <div class='col-sm-4'>
                                              <input type='text' class='form-control' id='inputName' name = 'updateName' 
                                                 value ='".$row['pName']."'>
                                            </div>
                                            </div>


                                          <div class='form-group'>
                                              <label for='inputStatus' class='col-sm-2 control-label'>Status:</label>
                                              <div class='col-sm-10'>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_status' value='MORGUE' >MORGUE
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_status' value='IMMEDIATE'>IMMEDIATE
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_status' value='DELAYED' >DELAYED
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_status' value='MINOR' checked>MINOR
                                                </label>
                                            </div>
                                          </div>

                                          <div class='form-group'>
                                            <label class='col-md-2 control-label'>IMMEDIATE:</label>
                                            <div class='col-md-10'>
                                              <label class='col-md-3 control-label'>Respirations</label>
                                                <label class='radio-inline'>
                                                <input type='radio' name='select_respirations' value='Yes'>Yes
                                              </label>
                                              <label class='radio-inline'>
                                                <input type='radio' name='select_respirations' value='No'>No
                                              </label>
                                              <label class='radio-inline'>
                                                <input type='radio' name='select_respirations' value='None' checked>None
                                              </label>
                                            </div>
                                            <label class='col-md-2 control-label'></label>
                                            <div class='col-md-10'>
                                              <label class='col-md-3 control-label'>Perfusion</label>
                                                <label class='radio-inline'>
                                                <input type='radio' name='select_perfusion' value='+2s'>+2 Sec
                                              </label>
                                              <label class='radio-inline'>
                                                <input type='radio' name='select_perfusion' value='-2s'>-2 Sec
                                              </label>
                                              <label class='radio-inline'>
                                                <input type='radio' name='select_perfusion' value='None' checked>None
                                              </label>
                                            </div>
                                             <label class='col-md-2 control-label'></label>
                                            <div class='col-md-10'>
                                              <label class='col-md-3 control-label'>Mental_Status</label>
                                                <label class='radio-inline'>
                                                <input type='radio' name='select_mentalStatus' value='Do'>Can do
                                              </label>
                                              <label class='radio-inline'>
                                                <input type='radio' name='select_mentalStatus' value='Not'>Can Not Do
                                              </label>
                                              <label class='radio-inline'>
                                                <input type='radio' name='select_mentalStatus' value='None' checked>None
                                              </label>
                                            </div>
                                            
                                          </div>

                                          <div class='form-group'>
                                              <label for='inputPatientCondition' class='col-sm-2 control-label'>Patient Condition:</label>
                                              <div class='col-sm-10'>
                                              <textarea class='form-control' name = 'updatePatientCondition' rows='3' id='inputPatientCondition' >".$row['pCondition']."</textarea>
                                            </div>
                                          </div>

                                          <div class='form-group'>
                                          <label for='inputAge' class='col-sm-2 control-label'>Age:</label>
                                              <div class='col-sm-2'>
                                              <input type='text' class='form-control' id='inputAge' name = 'updateAge'
                                                 value='".$row['age']."'>
                                            </div>
                                              <label for='inputGender' class='col-sm-2 control-label'>Gender:</label>
                                              <div class='col-sm-5'>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_gender' value='Male' checked>Male
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_gender' value='Female'>Female
                                                </label>
                                                
                                            </div>
                                            
                                          </div>



                                          <div class='form-group'>
                                              <label for='inputMobile' class='col-sm-2 control-label'>Mobile:</label>
                                              <div class='col-sm-10'>
                                              <input type='text' class='form-control' id='inputMobile' name = 'updateMobile'
                                                 value='".$row['mobile']."'>
                                            </div>
                                          </div>


                                          <div class='form-group'>
                                              <label for='inputAddress' class='col-sm-2 control-label'>Address:</label>
                                              <div class='col-sm-10'>
                                              <input type='text' class='form-control' id='inputMobile' name = 'updateAddress'
                                                 value='".$row['address']."'>
                                            </div>
                                          </div>
                               </div>
                               <div class='modal-footer'>
                                  <button type='button' class='btn btn-primary' data-dismiss='modal'>
                                    Cancle
                                  </button>
                                  <button type='submit' class='btn btn-primary' value = '".$row['P_ID']."' name='updateBtn_P_ID'>
                                     Update
                                  </button>
                               </div>
                               </form>
                            </div>
                      </div>
                </div> "; 
                echo $editPatient;
              }
            }
      ?>
<!-- END UPDATE -->
      <?php
      require 'dbConnection.php';
      $sql = "SELECT P_ID FROM patients";
      $result = $db->query($sql);

      if(count($result) != 0 ){
          foreach ($result as $row) {
            //(isset($_POST["select_by"])) ? $query = $_POST["select_by"] : $query='Status';
            $removePatient = "<div class='modal fade' id='removeP_".$row['P_ID']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                        &times;
                                  </button>
                                  <h4 class='modal-title' id='myModalLabel'>
                                     Remove Selected Patient
                                  </h4>
                               </div>
                            <div class='modal-body'>
                                
                              <p><span class='glyphicon glyphicon-warning-sign'></span>WARNING!</p>
                              <p>Do you make sure to remove the selected Patient (patient id: ".$row['P_ID'].")? </p>         
                              <p>If removed, you can not recover the data!</p>                               

                            </div>
                               <div class='modal-footer'>
                               <form class='form-horizontal' role='form' method = 'POST' action = 'patientlist_refresh.php' id = 'patientForm' name = 'patientForm'>
                                  <button type='button' class='btn btn-primary' data-dismiss='modal'>
                                    Cancle
                                  </button>
                                  <button type='submit' class='btn btn-danger' value = '".$row['P_ID']."'name='removeBtn_P_ID'>
                                     Remove
                                  </button>
                               </div>
                               </form>
                            </div>
                      </div>
                </div> "; 
                echo $removePatient;
              }
            }
      ?>
        <!-- end Modal -->

  
  

</body>

  
</html>




 