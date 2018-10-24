
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
<html>
  <head>
    <title>Add Incidents</title >
    
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
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
    <style>
    .error{
      color: red;
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
                <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Add Incidents
                            
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> Add Incidents
                            </li>
                        </ol>
                    </div>
                </div>
                                <div>
                <?php
                  //Form Submission takes us here.  Checks if the button has been clicked
                  if(isset($_POST["go"])){
                    //Checks if there is an incident statement
                    if($_POST['incident'] == 0){
                      echo "<h3 class = 'error'> Please select and incident</h3>";
                      exit(0);
                    }
                    //echo $_POST['incident']."<br>";

                    if(!$_POST['desc'] || $_POST['desc'] == ''){
                      echo "<h3 class = 'error'> Pleas give a discription of the incident.</h3>";
                      exit(1);
                    }
                    //echo "<br>".htmlspecialchars($_POST["desc"]);
                    if(!$_POST['stmt']){
                      echo "<h3 class = 'error'>Please write a mission statement</h3>";
                      exit(2);
                    }
                    //echo "<br>".$_POST['stmt'];
                    if(!$_POST['selected']){
                      echo "<br><h3 class = 'error'>Please make a selection from the staff list</h3>";
                      exit(3);
                    }
                    $i = 0;
                    
                    require 'dbConnection.php';
                    $sql = "Select type from Incident_Type where id =".$_POST['incident'];
                    //echo $sql."<br>";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                      // output data of row
                      $row = $result->fetch_assoc();
                      $get_type = $row['type'];
                    }

   

                    $stmt = $db->prepare("INSERT INTO Incidents (type,name,description,mission_stmt,status) VALUES(?,?,?,?,?)");
                    $stmt->bind_param('sssss', $type,$name,$desc,$mission_stmt, $status);
                    $status = "in progress";
                    $type = $_POST['status'];
                    $name = $get_type;
                    $desc = htmlspecialchars($_POST['desc']);
                    $mission_stmt = htmlspecialchars($_POST['stmt']);

                    if($stmt->execute()){
                      /*echo"<div class=\"alert alert-success\" role=\"alert\">";
                      echo "<h3>The incident is now in the database.</h3>";
                      echo"</div>";*/
                    }else{
                       printf("Error: %s.\n", $stmt->error);
                       Echo "\n".$type."\n".$name."\n".$desc."\n".$mission_stmt;
                    }
                    // close statement 
                    $stmt->close();

/*
                    $To = 'recepient@yourdomain.com'; 
                    $Subject = 'Send Email'; 
                    $Message = 'This example demonstrates how you can send plain text email with PHP'; 
                    $Headers = "From: sender@yourdomain.com \r\n" . 
                    "Reply-To: sender@yourdomain.com \r\n" . 
                    "Content-type: text/html; charset=UTF-8 \r\n"; 
                      
                    mail($To, $Subject, $Message, $Headers);*/ 
                    $sql = "SELECT I_ID from Incidents ORDER BY I_ID DESC LIMIT 1";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                      // output data of row
                      $row = $result->fetch_assoc();
                      $get_I_id = $row['I_ID'];

                    }

                    
                    foreach ($_POST['selected'] as $selectedStaff){
                      //echo $selectedStaff."\n";
                      $staff_name = "SELECT First_Name, Last_Name FROM staff WHERE ID = ".$selectedStaff;
                      $result = $db->query($staff_name);
                      
                      if ($result->num_rows > 0) {
                        // output data of row
                        if ($row = $result->fetch_assoc()){
                          $s_name = $row['First_Name']." ".$row['Last_Name'];
                        }else{
                          echo $db->error;
                        }
                      }else{
                        echo 'Failed';
                        exit(0);
                      }
                      $sql = "INSERT INTO Inc_Staff (is_ID, Staff_id, name) VALUES (".$get_I_id.",".$selectedStaff.",'".$s_name."')";
                      if ($db->query($sql) === TRUE) {
                        //echo "New record created successfully";
                      } else {
                          echo "Error: " . $sql . "<br>" . $db->error;
                      }
                    }
                      $sql = "UPDATE staff SET Status = 'Unavailable' WHERE ID =".$selectedStaff;
                      if(!$db->query($sql)){
                        echo 'status failure update';
                        exit (01);
                      }
                    


                    $sql = "SELECT Staff_id, name FROM Inc_Staff WHERE is_ID = ".$get_I_id;
                    $result = $db->query($sql);
                    
                    if($result->num_rows){
                      
                      while($row = $result->fetch_assoc()){
                        //echo $row['Staff_id'];
                        //print_r($_SESSION);
                        $theSql = "SELECT Email FROM staff WHERE ID =".$row['Staff_id'];
                        $theResult = $db->query($theSql);
                        
                        if ($line = $theResult->fetch_assoc()) {
                          $recepient = $line['Email'];
                        }

                        $to = $recepient;
                        //echo $to;
                        $subject = "New Incident";
                        $message = $desc;
                        $headers = "From:".$_SESSION['email'];
                        if(!mail($to, $subject, $message, $headers)){
                          echo"<div class=\"alert alert-danger\" role=\"alert\">";
                          echo "<h5>The Notification was not sent to ".$row['name']."</h5>";
                          //echo "<h5><a href = 'glass_streams.php'>Click here to view the video feeds</a></h5>";
                          echo"</div>";
                        }

                      }
                      echo"<div class=\"alert alert-success\" role=\"alert\">";
                      echo "<h5>The incident is now in the database.<a href = 'incidentlist.php'>Click here to view the incident</a></h5>";
                      echo"</div>";

                      $date = date('Y-m-d');
                      $time = date('H:i:s');
                      $sql = "INSERT INTO notifications (type, description,note_date,time) VALUES ('".$_POST['incident']."','".$desc."','".$date."','".$time."')";
                      if(!$db->query($sql)){
                        echo "Failed at inserting into the notifications";
                      }
                    }




                    $db->close();
                  }
                ?>
              </div>
    <form method = "POST" id = "inc_form" action = "<?= $_SERVER['PHP_SELF'] ?>" role = "form">
      <h4>Select Type of Incident</h4>
      <input type="radio" name="status" value="Actual Incident"> Real Incident<br>
            <input type="radio" name="status" value="Exercise/Drill" checked = 'true'> Exercise/Drill<br>
            <select name = 'incident' form = "inc_form">
            <option value="0">Select An Incident</option> 
            <?php

              require "../../../../Secure/dbConnection.php";
              $sql = "SELECT * FROM Incident_Type";
              $result = $db->query($sql);
              if ($result->num_rows){
                while($row = $result->fetch_assoc()){
                  echo"<option value = ".$row['id'].">".$row['type']."</option>";
                }
              }
              echo'</select>';
              $db->close();
            ?>

            <div class="description">
              <h4>Incident Description</h4>
              <div class="form-group">
                <label for="comment">This notification will be sent out to all specified contacts:</label><br>
                <textarea name = "desc" class="form-control" rows="5" id="comment" placeholder = "Enter description here"></textarea>
              </div>
              
            </div>

            <div class="InMiStat">
              <h4>Incident Mission Statement</h4>
              <div class="form-group">
                <textarea name = "stmt" class="form-control" rows="5" id="comment" placeholder = "Enter Mission Statement Here"></textarea>
              </div>
            </div>
            <div>
              <h3>Select Staff</h3>
              <div id = "selections">
                <a href="#" id = 'all'>select all</a>
                <a href="#" id = 'none'>remove all</a>
              </div>
              <div id = "info">

                <select multiple="multiple" id="staff1" name="selected[]">
                  <?php
                    require "../../../../Secure/dbConnection.php";
                      $sql = "SELECT * FROM staff";
                      $result = $db->query($sql);
                      if ($result->num_rows){
                        while($row = $result->fetch_assoc()){
                          echo"<option value = ".$row['ID'].">".$row['First_Name']." ".$row['Last_Name']." | ".$row['Job']."</option>";
                        }
                      }
                      echo'</select>';
                      $db->close();

                  ?>
                
                <script src="js/jquery.multi-select.js" type="text/javascript"></script>
                <script type="text/javascript">
                  $('#staff1').multiSelect();
                  $('#all').click(function(){
                    $('#staff1').multiSelect('select_all');
                    return false;
                  });
                  $('#none').click(function(){
                    $('#staff1').multiSelect('deselect_all');
                    return false;
                  });

                </script>
                </div>
            </div>
            <br>
            <div>
              <button type = "submit" class="btn btn-primary btn-lg btn-block"name = "go" id = "submit">Submit Incident</button>
            </div> 
    </form>
    </div>


                </div>
</div>
</body>
</html>
