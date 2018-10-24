<!DOCTYPE HTML>
<html>
<head>
<style>
	#red{
	color: red;
	}
	#yellow{
		color:yellow;
	}
	#green{
		color:green;
	}
	#black{
		color:black;
	}
	.body{
		background-color:black;
		font-size: 48pt;
		color: white;
		text-align: center;
		font-family: trebuchet, times;
	}
</style>
</head>

<body class = 'body'>

<?php
require 'dbConnection.php';

$color = $_GET['color'];
$nameOfStatus = "MINOR";

if ($color == 'red'){
	echo '<h1> Update Successful!<br></h1>';
	//echo '<h1 id = "red"> The color is red</h1>';
	$nameOfStatus = "IMMEDIATE";
}
if($color=='yellow'){
	//echo '<h1 id = "yellow"> The color is yellow</h1>';
	echo '<h1> Update Successful!<br></h1>';
	$nameOfStatus = "DELAYED";
}
if($color=='green'){
	echo '<h1> Update Successful!<br></h1>';
	//echo '<h1 id = "green"> The color is green</h1>';
	$nameOfStatus = "MINOR";
}if($color=='black'){
	echo '<h1> Update Successful!<br></h1>';
	//echo '<h1 id = "black"> The color is black</h1>';
	$nameOfStatus = "MORGUE";
}
if ($color == '' || $color == NULL){
	echo "The update failed.";
}

$sql="UPDATE `patients` SET `status`='".$nameOfStatus."' WHERE `P_ID`=32";
$result = $db->query($sql);


if ($result === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $coffee->error;
}
/*
$sql = "SELECT * FROM patients ORDER BY status";
$result = $db->query($sql); 
  if ($result->num_rows>0){
  	while($row = $result->fetch_assoc()) {
  		if ($row['Status']){
  		//echo "ID = " .$row['id']. " | Status = " .$row['Status']." | Time " .$row['time']."<br>";
  		
  	}
  	}

  }
*/
?>

</body>
</html>