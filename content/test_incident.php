<!DOCTYPE html>
<html>
	<head>
		<title>Add Incidents</title>

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
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <link href="../css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
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
                <textarea name = "disc" class="form-control" rows="5" id="comment"></textarea>
              </div>
              
            </div>

            <div class="InMiStat">
              <h4>Incident Mission Statement</h4>
              <div class="form-group">
                <textarea name = "stmt" class="form-control" rows="5" id="comment"></textarea>
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
                
                <script src="../js/jquery.multi-select.js" type="text/javascript"></script>
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
    <div>
      <?php
        if(isset($_POST["go"])){
          if($_POST['incident'] == 0 || !$_POST['incident']){
            echo "<h3 class = 'error'> Please select and incident</h3>";
          }
          
        }
      ?>

    </div>
    </div>
  </div>
</div>
  
	</body>
</html>