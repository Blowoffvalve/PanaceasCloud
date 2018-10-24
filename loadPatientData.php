<?php  
	// // Start XML file, create parent node 
	// Select all the rows in the markers table  
	
	require("dbConnection.php");  
		
	// $patLocSql = "SELECT * from temppatients_locations ORDER BY time DESC;";  
	$patLocSql = "SELECT patients".'.'."P_ID, patients".'.'."pName, patients".'.'."status, patients".'.'."I_ID, patients".'.'."incidentName, temppatients_locations".'.'."location_lat, temppatients_locations".'.'."location_lng, temppatients_locations".'.'."time from patients, temppatients_locations,incidents where temppatients_locations".'.'."P_ID = patients".'.'."P_ID and patients".'.'."I_ID = incidents".'.'."I_ID and incidents".'.'."status = 'Running' ORDER BY time DESC";
			// select max(time) ,Person_ID,location_lng,location_lat from locations group by Person_ID
	$patLocResult = $db->query($patLocSql);  
	if (!$patLocResult) {  
			die('Invalid query: ' . mysql_error());  
	}  
			  
			// Iterate through the rows, adding XML nodes for each
	$patientData = []; 
	foreach($patLocResult as $row) {
		$key = $row['P_ID'] . "," . $row['pName']. "," . $row['I_ID'] . "," . $row['incidentName'] . "," . $row['status'];
		$patientData[$key] = [];
	}
	foreach ($patLocResult as $row ) {
		$key = $row['P_ID'] . "," . $row['pName']. "," . $row['I_ID'] . "," . $row['incidentName'] . "," . $row['status'];
		$patientInfo = [];
		// $patientInfo["P_ID"] = $row['P_ID'];
		// $patientInfo["pName"] = $row['pName'];
		$patientInfo["pStatus"] = $row['status'];
		// $patientInfo["I_ID"] = $row['I_ID'];
		// $patientInfo["iName"] = $row['incidentName'];
		$patientInfo["pTime"] = $row['time'];
		$patientInfo["pat_lat"] = $row['location_lat'];
		$patientInfo["pat_lng"] = $row['location_lng'];
		$patientInfoJson = json_encode($patientInfo);
		array_push($patientData[$key],$patientInfoJson);
	}
	
	echo json_encode($patientData);			  
	// echo $result;
	// echo $dom->saveXML();  
?>    