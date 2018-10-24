<!DOCTYPE HTML>
<html>
<head>
<style>
	body{
			background-color: black;
			font-size: 70pt;
			color:white;
			text-align: center;
			font-family: trebuchet,times;
	}
</style>
</head>
<body>

<?php


require 'dbConnection.php';
$color = $_GET['color'];
$id = $_GET['ID'];

if($color == 'red'){
	$status = 'critical';
}

if($color == 'yellow'){
	$status = 'escalating';
}

if($color == 'green'){
	$status = 'stable';
}

if($color == 'black'){
	$status = 'dead';
}

if($color == '' || $color == NULL ||$id == NULL || $id == ''){
	echo "The update failed.";
}

$sql = "UPDATE PATIENTS SET STATUS = '".$status."' WHERE ID = ".$id;

if($db->query($sql)){
	
	echo "Update Successful <br> Swipe down to return<br> <a href = 'test.php'>click</a>";
}

else{
		echo "Fail";

}

$db->close();


?>

</body>
</html>