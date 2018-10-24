<?php
	// Load Wordpress before everthing else if possible (Ultimate Member plugin has a bug if loaded below)
	require 'serverSettings.php';
	if(file_exists($PanaceaServer["wordpressInstall"].'wp-load.php')) require_once($PanaceaServer["wordpressInstall"].'wp-load.php');
			//Making sure the login form has https
			/*if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
	            $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	            header("Location: $redirect");
	        }*/
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Panacea's Cloud Login</title >
    
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
    		<h1><img src="panacea.jpg" alt="panacea_logo" style="height: 50px;"> | <small>Secure Login</small></h1> 
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
				if(isset($_SESSION['status']) && $_SESSION['status'] == 'true'){
					header("Location: index.php");	
				}
				
				//connecting to the database
			    require 'dbConnection.php';
				
				//Checking if the user clicked the submit button.
		        if(isset($_POST['submit'])){

			        //Varibles 
			        $email = htmlspecialchars($_POST['email']);
			        if(!$email){
			        	echo "<h3 class = 'bg-danger'>Error: You must enter an email address.</h3>";
			        	exit(-1);
			        }

			        $password = htmlspecialchars($_POST['password']);
			        if(!$password){
			        	echo "<h3 class = 'bg-danger'>Error: The password section can't be blank.</h3>";
			        	exit(-1);
			        }
					$sql = "SELECT hashed_pass, salt FROM admin_login WHERE email = ?";
				    $stmt = $db->prepare($sql);
					if($stmt === false) {
					  	//trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
					}
					$email = htmlspecialchars($_POST["email"]);
				
		          	//Binding the parameter
	          		if(!$stmt->bind_param('s', $email)){
	          			//echo "parameter binding failed";
	          		}
	          		//execute query 
	    			if(!$stmt->execute()){
	    				//echo "execution failed";
	    			}
	    			//Bind results to variables
	    			if(!$stmt->bind_result($hashed_pass, $salt)){
	    				//echo"result binding failed";
	    			}
	    			$stmt -> fetch();
	    		
	    		
	    		
					if($hashed_pass=="") {
						// Couldn't find user in local user database; try Wordpress;
						wordpressLogin(true, $email, $password);
					    
					} else {
						// Found user in local user database
						
						$f_salt = sha1($salt);
						$f_salt = trim($salt);
						$hash = sha1($password.$f_salt);
						$i = 0;
						while ($i<10000){
							$hash = sha1($hash);
							$i++;
						}
					
						if($hash === $hashed_pass){
		
								$_SESSION['status'] = "true";
								$_SESSION['email'] = $email;
								$_SESSION['wordpress'] = false;
								echo "<script>window.location = 'index.php'</script>";
						}else{
							echo "<h3 class = 'bg-danger'>Error: Your username/password are incorrect.</h3>";
						}
					}

					$stmt->close();
					$db->close();

		        } else {
			        // Try logging in with wordpress on the first page load too
			        wordpressLogin();
		        }
		        
		        function wordpressLogin($displayWarning = false, $email = "", $password = "") {
			        global $db, $PanaceaServer;
			        
			        // Tries to log in to Wordpress
			        require 'serverSettings.php';
			        if(file_exists($PanaceaServer["wordpressInstall"].'wp-load.php')) { // Check if Wordpress is installed
				        debugMessage("found wordpress");
							
						require_once($PanaceaServer["wordpressInstall"].'wp-load.php');
						
						debugMessage("loaded wordpress");
	    
						if ( is_user_logged_in() ) { // could add statement here to check for min permissions needed
							debugMessage("user logged in");
							// Logged in already so log in to demo
							$current_user = wp_get_current_user();
							loginWPUser($current_user);
							        
					    } else {
						    
						    $username = get_user_by( 'email', $email )->user_login;
						    $user = wp_authenticate($username, $password);
						    
							if(is_wp_error($user)) {
								if($displayWarning) {
								    debugMessage("user not logged in");
								    echo "<h3 class = 'bg-danger'>Error: Your username/password are incorrect..</h3>";
							    } else {
								    debugMessage("user not logged in");
							    }
							} else {
								// User logged into Wordpress from the demo site login
								debugMessage("user logged in backward");
								wp_set_auth_cookie($user->ID);
								loginWPUser($user);
								
							}
						    
					    }
					} else {
						debugMessage("not found wordpress");
					}
		        }
		        
		        // Update local user system and log in user
		        function loginWPUser($wp_user) {
			        global $db;
			        
			        // User needs to be updated in local system
			        $sql = "REPLACE INTO admin (fname, lname, email) VALUES (?, ?, ?)";
					$stmt = $db->prepare($sql);
					$stmt->bind_param('sss', $wp_user->user_firstname, $wp_user->user_lastname, $wp_user->user_email);
	          		$stmt->execute();
	          		
	          		$_SESSION['status'] = "true";
					$_SESSION['email'] = $wp_user->user_email;
					$_SESSION['wordpress'] = true;
					echo "<script>window.location = 'index.php'</script>";
			        
		        }
		        
		        function debugMessage($mes) { //Uncomment to display debugMessages
			        //echo "<h3 class = 'bg-danger'>DEBUG: ".$mes."</h3>";
		        }

				?>
			</div>
		</div>



	</body>
</html>