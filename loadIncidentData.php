<?php  
	// // Start XML file, create parent node 
	// Select all the rows in the markers table  
	
	require("dbConnection.php");  
		
	// $incLocSql = "SELECT * from tempincidents_locations ORDER BY time DESC;";  
	$incLocSql = "SELECT incidents".'.'."I_ID, incidents".'.'."name, incidents".'.'."status, incidents".'.'."type, incidents".'.'."time from incidents where incidents".'.'."status = 'Running' ORDER BY time DESC";
			// select max(time) ,Person_ID,location_lng,location_lat from locations group by Person_ID
	$incLocResult = $db->query($incLocSql);  
	if (!$incLocResult) {  
			die('Invalid query: ' . mysql_error());  
	}  
			  
			// Iterate through the rows, adding XML nodes for each
	$incidentData = []; 
	foreach($incLocResult as $row) {
		$key = $row['I_ID'] . "," . $row['name'];
		$incidentData[$key] = [];
	}
	foreach ($incLocResult as $row ) {
		$key = $row['I_ID'] . "," . $row['name'];
		$incidentInfo = [];
		$incidentInfo["I_ID"] = $row['I_ID'];
		$incidentInfo["iName"] = $row['name'];
		// $incidentInfo["iStatus"] = $row['status'];
		// $incidentInfo["iType"] = $row['type'];
		$incidentInfo["iTime"] = $row['time'];
		
		$incidentInfoJson = json_encode($incidentInfo);
		array_push($incidentData[$key],$incidentInfoJson);
	}
	
	echo json_encode($incidentData);			  
	// echo $result;
	// echo $dom->saveXML();  
?>    