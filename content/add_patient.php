<?php           
    session_start();         
                    //checking if the user is logged in 
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
                        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        header("Location: $redirect");
                    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Panacea's Glass" content="">
    <meta name="Mark Vassell and Olivia Apperson" content="">

    <title>Add Incidents Template</title>

    <!-- Bootstrap Core CSS -->
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
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="http://code.jquery.com/jquery.latest.min.js"></script>

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
            	<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Patients
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus-square"></i> Add Patients
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" method = "POST" action = '<?php echo $_SERVER['PHP_SELF'];?>'>
                            <div class="form-group">
                                <label class = "col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                  <input class="form-control" name = "Firstname" placeholder="Enter first name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for = "Lastname" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                  <input class="form-control" name = "Lastname" placeholder="Enter last name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                  <label class="radio-inline">
                                      <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="Stable" checked>Stable
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="Esculating">Esculating
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3" value="Critical">Critical
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="Dead">Dead
                                  </label>
                                </div>
                            </div>
                            <div>
                             <button type="submit" name = 'submit' class="btn btn-default">Submit</button>
                            </div>
 
				            </div>
				        </div>


			</div>
			<?php
        	if (isset($_POST['submit'])){
        	  if (!$_POST['Firstname']){
            	echo "<div class=\"alert alert-danger\" role=\"alert\">";
            	echo "<h3>Please enter a first name before submitting the form!</h3>";
            	echo "</div";
            	exit(0);
          	}else if(!$_POST["Lastname"]){
            	echo "<div class=\"alert alert-danger\" role=\"alert\">";
            	echo "<h3>Please enter a last name before submitting the form!</h3>";
            	echo "</div>";
            	exit(1);
          	}
			else if (!$_POST["optionsRadiosInline"]){
	            echo "<div class=\"alert alert-danger\" role=\"alert\">";
	            echo "<h3>Please enter a valid status</h3>";
	            echo "</div>";
            exit(4);
          }
           //Connecting to the Database
          require 'dbConnection.php';
          //Prepareing the insert statement
          $stmt = $db->prepare("INSERT INTO PATIENTS (NAME, STATUS) VALUES (?,?)");
          //Binding the parameters
          $stmt->bind_param('ss', $name,$status);
          $name = htmlspecialchars($_POST['Firstname']).' '.htmlspecialchars($_POST['Lastname']);
          $status = $_POST["optionsRadiosInline"];
          if($stmt->execute()){
            echo"<div class=\"alert alert-success\" role=\"alert\">";
              echo "<h3>".$name." is now in the database. <a href = 'test.php'>view patients</a></h3>";

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

</body>
</html>