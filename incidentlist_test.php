
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
    

    <title>Edit Incidents Template</title >
    
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
        <h1>View Incidents</h1>
        <ol class="breadcrumb">
            <li>
            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
            <span class='glyphicon glyphicon-pencil'></span> View Incidents
            </li>
        </ol>
      </div>
      
  <div class="modal-body">
        <div class="row">
          <!-- <div class="col-md-12 col-sm-10 col-xs-12"> -->
            <div class="panel panel-primary">
                <div class="panel-body">
                  <?php (isset($_POST["search_by"])) ? $query = $_POST["search_by"] : $query='I_ID';?>
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                      <div class='form-group'>
                      <label class="col-md-2 control-label">Search by:</label>
                          <div class="col-md-12">
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'I_ID' ) echo "checked ='true' "; ?> value='I_ID'>ID
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'type' ) echo "checked ='true' "; ?> value='type'>Type
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'name' ) echo "checked ='true' "; ?> value='name'>Name
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'description' ) echo "checked ='true' "; ?> value='description'>Description
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'mission_stmt' ) echo "checked ='true' "; ?> value='mission_stmt'>Mission Statement
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'status' ) echo "checked ='true' "; ?> value='status'>Status
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'time' ) echo "checked ='true' "; ?> value='time'>Time
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
                  <th>Add Patient</th>
                  <th>Edit</th>
                  <th>Remove</th>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Mission Statement</th>
                  <th>Status</th>
                  <th>Time</th>
                </tr>
              </thead>
              
            <tbody>
                <?php
                  require 'dbConnection.php';
                  //print $testMsg . "</br>";
                  $type = htmlspecialchars($_POST['search_by']);
                  $query_string = htmlspecialchars($_POST['query_string']);
                  //print $query_string . "</br>";
                  $query_string = '%'.$query_string. '%';
                  //print "staff: " . $query_string . "</br>";
                  switch ($type) {
                      case "I_ID":
                          $sql = "SELECT * FROM incidents WHERE ".$type." LIKE '".$query_string."' ORDER BY I_ID DESC" ;
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                                $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                                $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                                $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                                $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                                "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                                echo $viewIncident;    
                            }
                          }else{
                            print "There is no incident.";
                          }
                          break;
                      case "type":
                          $sql = "SELECT * FROM incidents WHERE ".$type." LIKE '".$query_string."' ORDER BY I_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                                $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                                $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                                $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                                $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                                "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                                echo $viewIncident;    
                            }
                          }else{
                            print "There is no incident.";
                          }
                          break;
                      case "name":
                          $sql = "SELECT * FROM incidents WHERE ".$type." LIKE '".$query_string."' ORDER BY I_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                                $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                                $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                                $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                                $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                                "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                                echo $viewIncident;    
                            }
                          }else{
                            print "There is no incident.";
                          }
                          break;
                      case "description":
                          $sql = "SELECT * FROM incidents WHERE ".$type." LIKE '".$query_string."' ORDER BY I_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                                $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                                $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                                $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                                $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                                "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                                echo $viewIncident;    
                            }
                          }else{
                            print "There is no incident.";
                          }
                          break;
                      case "mission_stmt":
                          $sql = "SELECT * FROM incidents WHERE ".$type." LIKE '".$query_string."' ORDER BY I_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                                $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                                $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                                $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                                $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                                "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                                echo $viewIncident;    
                            }
                          }else{
                            print "There is no incident.";
                          }
                          break;
                      case "status":
                          $sql = "SELECT * FROM incidents WHERE ".$type." LIKE '".$query_string."' ORDER BY I_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                                $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                                $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                                $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                                $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                                "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                                echo $viewIncident;    
                            }
                          }else{
                            print "There is no incident.";
                          }
                          break;
                      case "time":
                          $sql = "SELECT * FROM incidents WHERE ".$type." LIKE '".$query_string."' ORDER BY I_ID DESC";
                          $result = $db->query($sql);
                          if(count($result) != 0 ){
                            foreach ($result as $row) {
                                $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                                $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                                $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                                $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                                $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                                "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                                echo $viewIncident;    
                            }
                          }else{
                            print "There is no incident.";
                          }
                          break;
                      default:
                        $sql = "SELECT * FROM incidents ORDER BY I_ID DESC";
                        $result = $db->query($sql);
                        if(count($result) != 0 ){
                          foreach ($result as $row) {
                              
                              //$buttonId = $row['I_ID'];
                              
                              //$form = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' > ";
                              $viewIncident = "<form method= 'POST' id = 'incidentForm' name = 'incidentForm' action = 'add_patient.php' >";
                              $viewIncident .= "<tr><td><button id = 'addPBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-info btn-sm btn-block' name='addPatient'><span class='glyphicon glyphicon-plus'></span>Add Patient</button></td></form>";
                              $viewIncident .= "<td><button id = 'subBtn' type='submit' value = '".$row['I_ID']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['I_ID']."'><span class='glyphicon glyphicon-pencil'></span>Edit</button></td>";
                              $viewIncident .= "<td><button id = 'rmBtn' type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-sm btn-block' name='remove' data-toggle='modal' data-target='#remove_".$row['I_ID']."'><span class='glyphicon glyphicon-trash'></span>Remove</button></td>";
                              $viewIncident .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['mission_stmt'].
                              "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                              echo $viewIncident;    
                              //echo $editIncident; 
                              //print "</br>" . "id = " . $_POST["edit"];
                          }
                        }else{
                          print "There is no incident.";
                        }

                  }
                  //$db->close;
                 
                ?>
    
                
                </tbody>

            </table>
              
            
          </div>
        </div>
        <!-- start Modal -->
          <!-- 模态框（Modal） -->
             

          </div>
      </div>
      <!-- modal body -->
      
    </div>
  </div>
    <!-- Modal -->
    <?php
      require 'dbConnection.php';
      $sql = "SELECT * FROM Incidents ORDER BY I_ID DESC";
      $result = $db->query($sql);

      if(count($result) != 0 ){
          foreach ($result as $row) {
            //(isset($_POST["select_by"])) ? $query = $_POST["select_by"] : $query='Status';
            $editIncident = "<div class='modal fade' id='edit_".$row['I_ID']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                        &times;
                                  </button>
                                  <h4 class='modal-title' id='myModalLabel'>
                                     Edit Selected Incident
                                  </h4>
                               </div>
                            <div class='modal-body'>
                                
                                      <form class='form-horizontal' role='form' method = 'POST' action = 'incidentlist_refresh.php' id = 'incidentForm' name = 'incidentForm'>
                                        <div class='form-group'>
                                         <label class='col-sm-2 control-label'>Incident_ID:</label>
                                              <div class='col-sm-10'>
                                                  <p class='form-control-static'>".$row['I_ID']."</p>
                                              </div>
                                            </div>

                                          <div class='form-group'>
                                            <label for='inputType' class='col-sm-2 control-label'>Type:</label>
                                            <div class='col-sm-10'>
                                              <input type='text' class='form-control' id='inputType' name = 'updateType' 
                                                 value ='".$row['type']."'>
                                            </div>
                                          </div>

                                          <div class='form-group'>
                                            <label for='inputName' class='col-sm-2 control-label'>Name:</label>
                                            <div class='col-sm-10'>
                                              <input type='text' class='form-control' id='inputName' name = 'updateName'
                                                 value='".$row['name']."'>
                                            </div>
                                          </div>

                                          <div class='form-group'>
                                              <label for='inputDescription' class='col-sm-2 control-label'>Description:</label>
                                              <div class='col-sm-10'>
                                              <textarea class='form-control' name = 'updateDescription' rows='2' id='inputDescription' >".$row['description']."</textarea>
                                            </div>
                                          </div>

                                          <div class='form-group'>
                                              <label for='inputMissionStatement' class='col-sm-2 control-label'>Mission Statement:</label>
                                              <div class='col-sm-10'>
                                              <textarea class='form-control' name = 'updateMissionStatement' rows='3' id='inputMissionStatement' >".$row['mission_stmt']."</textarea>
                                            </div>
                                          </div>

                                          <div class='form-group'>
                                              <label for='inputDescription' class='col-sm-2 control-label'>Status:</label>

                                              <div class='col-sm-10'>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_by' value='waiting'>Waiting
                                                     
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_by' value='running'>Running
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type='radio' name='select_by' value='completed' checked>Completed
                                                </label>
                                            </div>
                                          </div>

                                          <div class='form-group'>
                                            <label class='col-md-2 control-label'>Incident Time:</label>
                                            <div class='col-md-10'>

                                              <div class='input-group date col-md-5' id = 'datepick' >
                                                  <label class='input-group-btn' for='date-fld'>
                                                      <span class='btn btn-default' id = 'dateBtn'>
                                                          <span class='glyphicon glyphicon-calendar'></span>
                                                      </span>

                                                  </label>
                                                  <input type='text' id = 'dateInput' class='form-control date-input' value = '".$row['time']."' name='updateTime'>
                                              </div>
                                  
                                              </div>
                                            </div>

                               </div>
                               <div class='modal-footer'>
                                  <button type='button' class='btn btn-primary' data-dismiss='modal'>
                                    Cancle
                                  </button>
                                  <button type='submit' class='btn btn-primary' value = '".$row['I_ID']."' name='updateBtn_I_ID'>
                                     Update
                                  </button>
                               </div>
                               </form>
                            </div>
                      </div>
                </div> "; 
                echo $editIncident;
              }
            }
      ?>
<!-- END UPDATE -->
      <?php
      require 'dbConnection.php';
      $sql = "SELECT I_ID FROM Incidents ORDER BY I_ID DESC";
      $result = $db->query($sql);

      if(count($result) != 0 ){
          foreach ($result as $row) {
            //(isset($_POST["select_by"])) ? $query = $_POST["select_by"] : $query='Status';
            $removeIncident = "<div class='modal fade' id='remove_".$row['I_ID']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>  
                              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                        &times;
                                  </button>
                                  <h4 class='modal-title' id='myModalLabel'>
                                     Remove Selected Incident
                                  </h4>
                               </div>
                            <div class='modal-body'>
                                
                              <p><span class='glyphicon glyphicon-warning-sign'></span>WARNING!</p>
                              <p>Do you make sure to remove the selected Incident (incident id: ".$row['I_ID'].")? </p> 
                              <p>When removed, the related patients also will be removed.</p>          
                              <p>If removed, you can not recover the data!</p>                               

                            </div>
                               <div class='modal-footer'>
                               <form class='form-horizontal' role='form' method = 'POST' action = 'incidentlist_refresh.php' id = 'incidentForm' name = 'incidentForm'>
                                  <button type='button' class='btn btn-primary' data-dismiss='modal'>
                                    Cancle
                                  </button>
                                  <button type='submit' class='btn btn-danger' value = '".$row['I_ID']."'name='removeBtn_I_ID'>
                                     Remove
                                  </button>
                               </div>
                               </form>
                            </div>
                      </div>
                </div> "; 
                echo $removeIncident;
              }
            }
      ?>
        <!-- end Modal -->

  
  
    

</body>

  
</html>




 