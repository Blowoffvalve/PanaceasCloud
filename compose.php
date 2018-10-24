
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
                            Compose
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Message
                            </li>
                         </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    	<form method = 'POST' action = "<?= $_SERVER['PHP_SELF'] ?>">
                    		<div class="form-group">
                                <label>Recipient</label>
                                <select class="form-control" name = 'recipients'>
                                	<option value = '0' disabled>Select a recipient...</option>
                                	<?php
                                		require 'dbConnection.php';
						    	     	$sql = 'SELECT * FROM admin';
						    	     	$result = $db->query($sql);
						    	     	while($row = $result->fetch_assoc()){
						    	     	
						    	     		echo "<option value = ".$row['email'].">" .$row['fname']." ".$row['lname']."</option>";
						    	     	}
                          				$db->close();
                                	?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Text area</label>
                                <textarea class="form-control" rows="3" name = 'message'></textarea>
                            </div>
                            <div class = "form-group">
                            	<button type="submit" name = 'submit' class="btn btn-default">Send</button>
                            </div>
                        </form>  
                    </div>
                </div>
                <?php
                	if (isset($_POST['submit'])){
                		$recipient = $_POST['recipients'];
                		//$message =  htmlspecialchars($_POST['message']);

                			require 'dbConnection.php';
                			$sql = "Select fname, lname from admin where email = '".$recipient"'";
                			$result = $db->query($sql);
                			$row = $result->fetch_assoc();
                			$name = $row['fname'].' '.$row['lname'];
				          //Prepareing the insert statement
				          $stmt = $db->prepare("INSERT INTO messages (name, message) VALUES (?,?)");
				          //Binding the parameters
				          $stmt->bind_param('ss', $recipient,$message);
				          $recipient = $name;
				          $message = htmlspecialchars($_POST['message']);
				          if($stmt->execute()){
				            echo"<div class=\"alert alert-success\" role=\"alert\">";
				              echo "<h3>Message delivered to ".$recipient."</h3>";
				            echo"</div>";
				          }else{
				            echo "Failed";
				          }
				          // close statement 
				          $stmt->close();
				          $db->close();
                	}
                ?>


            </div>
        </div>
    </div>
</body>
</html>