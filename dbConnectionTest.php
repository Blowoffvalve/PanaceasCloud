<?php

print 'aaa';
try {
	$user = "root";
	$pass = "0cpV1lm87J8m";
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=panacea', $user, $pass);
    
    $email = "oamr6@mail.missouri.edu";

    $sql = "SELECT hashed_pass, salt FROM admin_login WHERE email = ? ";

	$stmt = $dbh->prepare($sql);
	
	$stmt->execute(array($email));
	print $sql;
	$stmt->execute();
	$stmt->bindColumn(1, $hashed_pass);
	while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
      $data = $hashed_pass;
      print $data;
    }

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
include 'dbConnection.php';
echo "<script type='text/javascript'>alert('$message');</script>";
header("Location: test1.html");
?>