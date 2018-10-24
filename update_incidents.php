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
                     
                    if($_POST['edit']){
                      $_SESSION['incident_status'] = htmlspecialchars($_POST['edit']);
                    }
                    
                    if(isset($_POST['delete'])){
                    require 'dbConnection.php';
                    $sql = "select * from Incidents where I_ID =".$_POST['delete'];
                    //echo $sql;
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    $sql = "INSERT INTO Incidents_Archive (type,name,description,mission_stmt,status, time, arc_date) VALUES ('".$row['type']."','".$row['name']."','".$row['description']."','".$row['mission_stmt']."','".$row['status']."','".$time."','".$date."')";
                    //echo $sql;
                    //executing the last insert statement above
                    if(!$db->query($sql)){
                      echo "Failed to archive the incident";
                      exit(1);
                    }

                    $sql = "Delete FROM Incidents where I_ID =".$_POST['delete'];
                    
                    if(!$db->query($sql)){
                      echo "Failed to delete the incident";
                      exit(2);
                    }

                
                    echo "Incident archived <a href = 'incidentlist.php'>click here to get back to the incident page</a>";
                    $db->close();
                    //exit(0);
                    header('Location: incidentlist.php');
                    exit(0);
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
      <script src="https://code.jquery.com/jquery-latest.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      .center{
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
              <?php //echo $_SESSION['incident_status'];?>

      <?php
        //connection to the database
        require 'dbConnection.php';
        if(isset($_POST['update'])){          
          //gets the status and desc from the form
          $status = $_POST['optionsRadios'];
          $desc = htmlspecialchars($_POST['desc']);
          //pulling description from the database
          $sql = "SELECT description FROM Incidents WHERE I_ID =".$_SESSION['incident_status'];
          $result = $db->query($sql);
          $row = $result->fetch_assoc();
          $old_desc = $row['description'];
          //adding to the description in the database.
          $new_desc = $old_desc."\n<br>|".$desc;
         // echo $new_desc;
          $sql = "UPDATE Incidents SET description = '".$new_desc."', status = '".$status."' WHERE I_ID = ".$_SESSION['incident_status'];
          $result = $db->query($sql); 
          if ($result){
            if(!$status == 'Resolved'){
              echo "The update is successful \n";
              echo "<a href = \"incidentlist.php\">Click here to return to the incident list page</a>";
            }else{
              echo "<div class = \"success\">The incident is resolved return the <a href = \"incidentlist.php\">incident list page</a> to archive it.</div>";
            }
          }
        }
          $db->close();

        

      ?>

                <!-- Page Heading -->
                  <div id = "title3">
                    <h1>update incident</h1>
                  </div>
                  <div class = 'row'>
                    <div class = 'col-lg-6 center'>
                      <h2>Assigned Staff</h2>
                      <table class="table table-condensed center">
                            <thead class = 'center'>
                              <tr>
                            
                                <th>Staff ID</th>
            
                                <th>Name</th>
                   
                              </tr>
                          </thead>
                        <tbody>
                      <?php
                        require 'dbConnection.php';
                        $sql = "SELECT * FROM Inc_Staff where is_ID = ".$_SESSION['incident_status'];
                        $result = $db->query($sql);
                        while ($row = $result->fetch_assoc()){
                          echo "<tr><td>".$row['Staff_id']."</td><td>".$row['name']."</td></tr>";
                        }
                        $db->close();

                      ?>
                    </tbody>
                  </table>

                    </div>
                    <div class = 'col-lg-6 center'>
                      <h2>Patients</h2>
                      <table class="table table-condensed">
                            <thead>
                              <tr>
                            
                                <th>ID</th>
            
                                <th>Name</th>
                      
                                <th>Status</th>
                   
                              </tr>
                          </thead>
                        <tbody>
                          <?php
                          require 'dbConnection.php';
                          $sql = 'SELECT * FROM PATIENTS';
                          $result = $db->query($sql);
                          while($row = $result->fetch_assoc()){
                            echo "<tr> <td>" .$row['ID']."</td><td>".$row['name']. "</td><td>".$row['STATUS']. "</td></tr>";
                          }
                          $db->close();
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

<br><br>
                  </div>
                  <div class = 'row'>
                    <div class="col-lg-12">
                      <form role = "form" action = "<?= $_SERVER['PHP_SELF'] ?>" method = "POST">
                      <div class="form-group">
                        <label>Select Current Status</label>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios" id="optionsRadios1" value="Escalating" checked>Escalating
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios" id="optionsRadios2" value="De-escalate">De-escalating
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios" id="optionsRadios3" value="Resolved">Resolved
                            </label>
                          </div>
                      </div>
                      <div class="form-group">
                          <label>Update Description</label>
                          <textarea class="form-control" name = 'desc' rows="3"></textarea>
                      </div>
                      <button type='submit' class='btn btn-primary btn-lg btn-block' name='update'><span class='glyphicon glyphicon-pencil'></span>Update Incident</button>
                    </form>
                  </div>
                </div>


 
        </div>
      </div>
</body>
</html>