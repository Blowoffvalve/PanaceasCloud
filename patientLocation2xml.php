<?php  
require("dbConnection.php");  

  
// Start XML file, create parent node  
$dom = new DOMDocument("1.0");  
$node = $dom->createElement("markers");  
$parnode = $dom->appendChild($node);  
  
// Select all the rows in the markers table  
$sql = "SELECT * from locations ORDER BY time DESC"; 
// $sql = "SELECT templocations".'.'."Person_ID, templocations".'.'."location_lat, templocations".'.'."location_lng, templocations".'.'."time, tempbeacons_patients".'.'."patient_id from templocations, tempbeacons_patients where templocations".'.'."time = tempbeacons_patients".'.'."time and templocations".'.'."Person_ID = tempbeacons_patients".'.'."lastseen";  

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
  $newnode->setAttribute("time", $row['time']);  
}
  

  
echo $dom->saveXML();  
  
?>    