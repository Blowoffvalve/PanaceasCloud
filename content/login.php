<?php
			//Making sure the login form has https
			$H = false;
			if($H){
	            $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	            header("Location: $redirect");
	        }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Panacea Login</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<!--My Personal style sheet -->
		<link rel="stylesheet" type="text/css" href="panacea.css">
		<!-- fontawsome link -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<!-- jQuery Link -->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


	</head>

	<body>

		<div class="wrapper">
    		<h1>Panacea Login | <small>Secure Content</small></h1> 
    		<div class = "container">
			<form class="form-horizontal" method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>">

				<div class="form-group input-group">
				    <span class="input-group-addon"><i class="fa fa-user"></i></span>
				    <input type="email" class="form-control" name = 'email' placeholder='Enter your email address here'>
				</div>
				<div class="form-group input-group">  
					<span class="input-group-addon"><i class="fa fa-paw"></i></span> 
				    <input type="password" class="form-control" id="password" name = "password" placeholder="Enter your password here">
				</div>
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-10">
				      <button type="submit" name = "submit" class="btn btn-default">Log in</button>
				    </div>
				  </div>
			</form>
			</div>
    	
	    	<div>

	    		<?php
	    		//checking if the admin is already logged in. If they are they will be redirected to the dashboard
				session_start();
					if($_SESSION['status'] == 'true'){
						header("Location: index.php");	
					}
				
				//Checking if the user clicked the submit button.
		        if(isset($_POST['submit'])){

			        //connecting to the database
			        require '../dbConnection.php';

			        //Varibles 
			        $email = htmlspecialchars($_POST['email']);
			        if(!$email){
			        	echo "<h3 class = 'bg-danger'>Error: You must enter an email address</h3>";
			        	exit(-1);
			        }

			        $password = htmlspecialchars($_POST['password']);
			        if(!$password){
			        	Echo "<h3 class = 'bg-danger'>Error: The password section can't be blank</h3>";
			        	exit(-1);
			        }

				$sql = "SELECT hashed_pass, salt FROM admin_login WHERE email = ?";

			    $stmt = $db->prepare($sql);
				if($stmt === false) {
				  	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
				}
				$email = htmlspecialchars($_POST["email"]);
				
	          	
          		//execute query 
    			if(!$stmt->execute(array($email))){
    				echo "execution failed";
    			}
    			//Bind results to variables
    			$stmt->bindColumn(1, $hashed_pass_result);
    			$stmt->bindColumn(2, $salt_result);

				while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
      				$hashed_pass = $hashed_pass_result;
      				$salt = $salt_result;
    			}
    			


				$f_salt = sha1($salt);
				
				$f_salt = trim($salt);

				$hash = sha1($password.$f_salt);
				$i = 0;
				while ($i<10000){
					$hash = sha1($hash);
					$i++;
				}
				//echo $hash;
				if($hash === $hashed_pass){
						$_SESSION['status'] = "true";
						$_SESSION['email'] = $email;
						echo "<script>window.location = '../content/index.php'</script>";


				}else{
					echo "<p class = 'bg-danger'>The login failed.  The credentials dont match</p>";
				}
				//print $_SESSION['username'];
				$stmt->close();
				$db->close();
		        }
				?>
			</div>
		</div>



	</body>
</html>