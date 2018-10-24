<?php
require 'dbConnection.php';

$num = $_REQUEST['num'];

$sql = "insert into tempstaffs_locations (S_ID, location_lng,location_lat,time)";
//$sql_beacon = "insert into beacons_locations (MAC_address, staff_id,time)";
$sql_patientsLocation = "insert into temppatients_locations (P_ID, location_lng, location_lat, time)";
$patients_location_index = 0;
for ($x = 0; $x < $num; $x++) {
    $info = explode(';', $_REQUEST['gpsInformation'.$x]);
    $MAC = explode(',', $info[4]);
    $num_beacon = $_REQUEST['num_beacon'.$x];
    	if($num_beacon == 0){
    		//$sql_beacon .= " values('','".$info[0]."','".$info[3]."')";
    	}else{
    		for($y = 0; $y < $num_beacon; $y++){
                $sql_getPatientID = "select P_ID from patients where Beacon_ID = (select id from beacons where MAC_Address = '".$MAC[$y]."')";
                $result_getPatientID = $db->query($sql_getPatientID);
                if($result_getPatientID->num_rows > 0){
                    $row = $result_getPatientID->fetch_assoc();
                    if($patients_location_index == 0){
                        $sql_patientsLocation .= " values('".$row['P_ID']."','".$info[2]."','".$info[1]."','".$info[3]."')";
                        $patients_location_index++;
                    }else{
                        $sql_patientsLocation .= " , ('".$row['P_ID']."','".$info[2]."','".$info[1]."','".$info[3]."')";
                        $patients_location_index++;
                    }
                }
    		}
    	}
    if($x == 0){
    	$sql .= " values('".$info[0]."','".$info[2]."','".$info[1]."','".$info[3]."')";
    }else{
    	$sql .= " , ('".$info[0]."','".$info[2]."','".$info[1]."','".$info[3]."')";
    }
    
} 


if($patients_location_index != 0){
    $result1 = $db->query($sql_patientsLocation);
}

$result = $db->query($sql);
print(json_encode($result));// this will print the output in json
$db->close();
?>