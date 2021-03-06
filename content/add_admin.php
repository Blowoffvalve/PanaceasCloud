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
		<div id = "wrap">
            <h1 id = 'h1'><small>Please Register</small></h1>
            <form method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name = "fname" placeholder="Enter first name">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name = "lname" placeholder="Enter last name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name = "email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" name = "pass" id="inputPassword" placeholder="Enter password">
                </div>
                <button type="submit" name = "submit" class="btn btn-default">Submit</button>

            </form>
 			<div>
 				<?php
 			        if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
                        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: $redirect");
                    }
			        //connecting to the database
			        require 'dbConnection.php';
                    if(!isset($_POST['submit'])){
                        exit(-1);
                    }else{
                        class varibles{
                            public $email, $pass, $hashedpassword, $salt, $firstname, $lastname;
                            //Setting my varible
                            public function setVaribles(){
                                $this->email = htmlspecialchars($_POST["email"]);
                                $this->pass = htmlspecialchars($_POST["pass"]);
                                $this->lastname = htmlspecialchars($_POST["lname"]);
                                $this->firstname = htmlspecialchars($_POST["fname"]);
                            }
                            //Creating and setting a Random Salt
                            public function salt(){
                                mt_srand();
                                $this->salt = mt_rand();
                                $this->salt = sha1($this->salt);
                            }
                            //Creating a hashed password
                            public function hash(){
                                $this->hashedpassword = sha1($this->pass.$this->salt);
                            }
                            //Slowly runs the hash
                            public function slowHash(){
                                $i = 0;
                                while($i<10000){
                                    $this->hashedpassword = sha1($this->hashedpassword);
                                    $i++;
                                }
                            }
                        }
                        $info = new varibles;
                        //sets the varible see (class varibles above)
                        $info->setVaribles();
                        //sets the sale see (class varibles above)
                        $info->salt();
                        //sets the hash see (class varible above)
                        $info->hash();
                        //see classs varibles above
                        $info->slowHash();
                       
                       	$stmt = $db->prepare("INSERT INTO admin_login(email, hashed_pass, salt) VALUES (?,?,?)");
                       	$stmt->bind_param("sss", $email, $hash, $salt);

                 		$email = $info->email;
                 		$hash = $info->hashedpassword;
                 		$salt = $info->salt;

                 		$stmt->execute();


                 		$stmt1 = $db->prepare("INSERT INTO admin (email, fname, lname) VALUES (?,?,?)");
                 		$stmt1->bind_param("sss", $email, $firstname, $lastname);

                 		$email = $info->email;
                 		$firstname = $info->firstname;
                 		$lastname = $info->lastname;
                 		$stmt1->execute();

                 		echo "New records created successfully. You can now login <a href='login.php'>click here</a>";

						$stmt->close();
						$stmt1->close();
						$db->close();
					}

 				?>

 			</div>
 			
 		</div>      
    </body>
</html>
