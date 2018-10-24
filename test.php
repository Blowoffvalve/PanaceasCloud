
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
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

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
                                <i class="fa fa-file"></i> Patient
                            </li>
                         </ol>
                          <div class = 'row'>
                            <h5><a href = 'add_patient.php'>Click here to add patients</a></h5>
                          </div>
                         	 <div class="row">

                    			<div class="col-lg-12">
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
                    </div>
                </div>
               <div>

            </div>
        </div>
    </div>
</div>

</body>

</html>