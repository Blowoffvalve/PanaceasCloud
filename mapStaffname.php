<?php
	require 'dbConnection.php';
	if($_GET['sid'] != ""){
		$staffId = $_GET['sid'];
        $sql = "SELECT tempstaffs".'.'." First_Name, tempstaffs".'.'."Last_Name FROM tempstaffs WHERE S_ID = '".$staffId."'";
        $result = $db->query($sql);
        $staffName = "";
        if(count($result) != 0 ){
          	foreach ($result as $row) {
          		$staffName = $row['First_Name'] . " " . $row['Last_Name'];
          	}
          	$content = "<div><label>Staff Name: ".$staffName."</label></div>";
          	echo $content;
      	}else{
      		echo "No staff name in database";
      	}
    }else{
    	// echo "Passing staff id error";
    }
?>