<?php  
	if($_GET['personID'] != ""){
		$Person_ID = $_GET['personID'];
		// echo $Person_ID;
	}else{
		echo "Wrong";
	} 
	// // Start XML file, create parent node 
	// $Person_ID = "R7"; 
	$dom = new DOMDocument("1.0");  
	$node = $dom->createElement("markers");  
	$parnode = $dom->appendChild($node);  
	  
	// Select all the rows in the markers table  
	
	require("dbConnection.php");  
		
	// $sql = "SELECT templocations".'.'."Person_ID, templocations".'.'."location_lat, templocations".'.'."location_lng, templocations".'.'."time, tempbeacons_patients".'.'."patient_id, patients".'.'."pName from templocations, tempbeacons_patients, patients WHERE templocations".'.'."time = tempbeacons_patients".'.'."time and templocations".'.'."Person_ID = tempbeacons_patients".'.'."lastseen and patients".'.'."P_ID = tempbeacons_patients".'.'."patient_id and tempbeacons_patients".'.'."lastseen = '".$Person_ID."'ORDER BY time ASC";  
	$sql = "SELECT templocations".'.'."Person_ID, templocations".'.'."location_lat, templocations".'.'."location_lng, templocations".'.'."time, tempbeacons_patients".'.'."patient_id, patients".'.'."pName from templocations LEFT JOIN tempbeacons_patients ON templocations".'.'."time = tempbeacons_patients".'.'."time and templocations".'.'."Person_ID = tempbeacons_patients".'.'."lastseen and tempbeacons_patients".'.'."lastseen = '".$Person_ID."' left join patients on  patients".'.'."P_ID = tempbeacons_patients".'.'."patient_id ORDER BY time ASC";  

			// select max(time) ,Person_ID,location_lng,location_lat from locations group by Person_ID
	$result = $db->query($sql);  
		if (!$result) {  
				die('Invalid query: ' . mysql_error());  
		}  
			  
	header("Content-type: text/xml");  
			  
			// Iterate through the rows, adding XML nodes for each  
	foreach ($result as $row ) {
			  # code...

		$node = $dom->createElement("marker");    
		$newnode = $parnode->appendChild($node);       
     	$newnode->setAttribute("lat", $row['location_lat']); 
		$newnode->setAttribute("lng", $row['location_lng']);    
		$newnode->setAttribute("Person_ID", $row['Person_ID']); 
		$newnode->setAttribute("patient_id", $row['patient_id']); 
		$newnode->setAttribute("patient_name",$row['pName']);
		$newnode->setAttribute("time", $row['time']);  
	}
			  

	echo $dom->saveXML();  
?>    