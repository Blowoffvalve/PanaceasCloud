<?php  
	// // Start XML file, create parent node 
	// Select all the rows in the markers table  
	
	require("dbConnection.php");  
		
	// $staLocSql = "SELECT * from tempstaffs_locations ORDER BY time DESC;";  
	$staLocSql = "SELECT tempstaffs".'.'."S_ID, tempstaffs".'.'."Status, tempstaffs".'.'."First_Name, tempstaffs".'.'."Last_Name, tempstaffs".'.'."Telephone, tempstaffs".'.'."Email, incidents".'.'."I_ID, incidents".'.'."name, incidents".'.'."status, tempstaffs_locations".'.'."location_lat, tempstaffs_locations".'.'."location_lng, tempstaffs_locations".'.'."time from tempstaffs, incidents, tempstaffs_locations where tempstaffs_locations".'.'."S_ID = tempstaffs".'.'."S_ID and tempstaffs".'.'."I_ID = incidents".'.'."I_ID and incidents".'.'."status = 'Running' ORDER BY time DESC";
			// select max(time) ,Person_ID,location_lng,location_lat from locations group by Person_ID
	// echo $staLocSql;
	$staLocResult = $db->query($staLocSql);  
	if (!$staLocResult) {  
			die('Invalid query: ' . mysql_error());  
	}  
	// echo $staLocResult->num_rows;
			// Iterate through the rows, adding XML nodes for each
	$staffData = []; 
	foreach($staLocResult as $row) {
		$key = $row['S_ID'] . "," . $row['First_Name'] . "_" . $row['Last_Name']. "," . $row['I_ID'] . "," . $row['name'];
		$staffData[$key] = [];
	}
	// echo count($staffLocResult);
	foreach ($staLocResult as $row ) {
		$key = $row['S_ID'] . "," . $row['First_Name'] . "_" . $row['Last_Name']. "," . $row['I_ID'] . "," . $row['name'];
		$staffInfo = [];
		// $staffInfo["S_ID"] = $row['S_ID'];
		// $staffInfo["sFirName"] = $row['First_Name'];
		// $staffInfo["sLasName"] = $row['Last_Name'];
		$staffInfo["sStatus"] = $row['Status'];
		// $staffInfo["sEmail"] = $row['Email'];
		// $staffInfo["sTel"] = $row['Telephone'];
		// $staffInfo["I_ID"] = $row['I_ID'];
		// $staffInfo["iName"] = $row['name'];
		$staffInfo["sTime"] = $row['time'];
		$staffInfo["sta_lat"] = $row['location_lat'];
		$staffInfo["sta_lng"] = $row['location_lng'];
		$staffInfoJson = json_encode($staffInfo);
		array_push($staffData[$key],$staffInfoJson);
	}
	
	echo json_encode($staffData);			  
	// echo $result;
	// echo $dom->saveXML();  
?>    