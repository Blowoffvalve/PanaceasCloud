<?php
  require 'dbConnection.php';

  if(isset($_POST['returnMapSubmit'])){
      header('Location: index.php');
  }

  if(isset($_POST['defaultOrderSubmit'])){
      header('Location: patientlist.php');
  }
  
   
  if(isset($_POST['updateBtn_P_ID_map'])){
        $pid = $_POST['updateBtn_P_ID_map'];
        $statusImmediate = "";
        $select_status = "select_status_" . $pid;
        if($_POST[$select_status] == "IMMEDIATE"){
          $R = "select_respirations_" . $pid;
          $P = "select_perfusion_" . $pid;
          $M = "select_mentalStatus_" . $pid;
          if($_POST[$R] == "None" && $_POST[$P] == "None" && $_POST[$M] == "None"){
            $statusImmediate = "None";
          }else if ($_POST[$R] == "None" && $_POST[$P] == "None") {
            $statusImmediate = $_POST[$M];
          }else if ($_POST[$R] == "None" && $_POST[$M] == "None") {
            $statusImmediate = $_POST[$P];
          }else if ($_POST[$M] == "None" && $_POST[$P] == "None") {
            $statusImmediate = $_POST[$R];
          }else if ($_POST[$R] == "None" ) {
            $statusImmediate = $_POST[$P] . "/" . $_POST[$M];
          }else if ($_POST[$M] == "None" ) {
            $statusImmediate = $_POST[$R] . "/" . $_POST[$P];
          }else if ($_POST[$P] == "None" ) {
            $statusImmediate = $_POST[$R] . "/" . $_POST[$M];
          }else{
            $statusImmediate = $_POST[$R] . "/" . $_POST[$P] . "/" . $_POST[$M];
          }
        }else if($_POST[$select_status] == "MORGUE"){
          $statusImmediate = "None";
        }else if($_POST[$select_status] == "DELAYED"){
          $statusImmediate = "None";
        }else if($_POST[$select_status] == "MINOR"){
          $statusImmediate = "None";
        }else{
          $statusImmediate = "None";
        }

        $patientStatus = "";
        if($_POST[$select_status] == null || $_POST[$select_status] == ""){
          $patientStatus = "Unknown";
        }else{
          $patientStatus = $_POST[$select_status];
        }
        
         //print $statusImmediate;
        //print $statusImmediate;
        $patientGender = "";
        if($_POST['select_gender'] == "default"){
          $patientGender = "Unknown";
        }else{
          $patientGender = $_POST['select_gender'];
        }

        $patientName = $_POST['updateFirstName']. " " . $_POST['updateLastName'];
        $patientName = $_POST['updateFirstName']. " " . $_POST['updateLastName'];
        if($_POST['updateBeacon_ID'] == 0){
          $sql = "UPDATE patients SET pFirstName = '".$_POST['updateFirstName']."', pLastName = '".$_POST['updateLastName']."', pName = '".$patientName."',status = '".$patientStatus."', statusImmediate = '".$statusImmediate."' , pCondition = '".$_POST['updatePatientCondition']."', age = '".$_POST['updateAge']."', gender = '".$patientGender."', mobile = '".$_POST['updateMobile']."', address = '".$_POST['updateAddress']."' , Beacon_ID = null WHERE P_ID = '".$_POST['updateBtn_P_ID_map']."'";
        }else{
          $sql = "UPDATE patients SET pFirstName = '".$_POST['updateFirstName']."', pLastName = '".$_POST['updateLastName']."', pName = '".$patientName."',status = '".$patientStatus."', statusImmediate = '".$statusImmediate."' , pCondition = '".$_POST['updatePatientCondition']."', age = '".$_POST['updateAge']."', gender = '".$patientGender."', mobile = '".$_POST['updateMobile']."', address = '".$_POST['updateAddress']."' , Beacon_ID = '".$_POST['updateBeacon_ID']."' WHERE P_ID = '".$_POST['updateBtn_P_ID_map']."'";
        }
        
        $result = $db->query($sql);
        // echo $sql;
                    //print "</br>".$_POST['updateType'];
        if(count($result) != 0){
            header('Location: index.php');
        }
  }

  if(isset($_POST['updateBtn_P_ID'])){
        $statusImmediate = "";
        if($_POST['select_status'] == "IMMEDIATE"){
          if($_POST['select_respirations'] == "None" && $_POST['select_perfusion'] == "None" && $_POST['select_mentalStatus'] == "None"){
            $statusImmediate = "None";
          }else if ($_POST['select_respirations'] == "None" && $_POST['select_perfusion'] == "None") {
            $statusImmediate = $_POST['select_mentalStatus'];
          }else if ($_POST['select_respirations'] == "None" && $_POST['select_mentalStatus'] == "None") {
            $statusImmediate = $_POST['select_perfusion'];
          }else if ($_POST['select_mentalStatus'] == "None" && $_POST['select_perfusion'] == "None") {
            $statusImmediate = $_POST['select_respirations'];
          }else if ($_POST['select_respirations'] == "None" ) {
            $statusImmediate = $_POST['select_perfusion'] . "/" . $_POST['select_mentalStatus'];
          }else if ($_POST['select_mentalStatus'] == "None" ) {
            $statusImmediate = $_POST['select_respirations'] . "/" . $_POST['select_perfusion'];
          }else if ($_POST['select_perfusion'] == "None" ) {
            $statusImmediate = $_POST['select_respirations'] . "/" . $_POST['select_mentalStatus'];
          }else{
            $statusImmediate = $_POST['select_respirations'] . "/" . $_POST['select_perfusion'] . "/" . $_POST['select_mentalStatus'];
          }
        }else if($_POST['select_status'] == "MORGUE"){
          $statusImmediate = "None";
        }else if($_POST['select_status'] == "DELAYED"){
          $statusImmediate = "None";
        }else if($_POST['select_status'] == "MINOR"){
          $statusImmediate = "None";
        }else{
          $statusImmediate = "None";
        }

        $patientStatus = "";
        if($_POST['select_status'] == null || $_POST['select_status'] == ""){
          $patientStatus = "Unknown";
        }else{
          $patientStatus = $_POST['select_status'];
        }
        
         //print $statusImmediate;
        //print $statusImmediate;
        $patientGender = "";
        if($_POST['select_gender'] == "default"){
          $patientGender = "Unknown";
        }else{
          $patientGender = $_POST['select_gender'];
        }

        $patientName = $_POST['updateFirstName']. " " . $_POST['updateLastName'];
        if($_POST['updateBeacon_ID'] == '0'){
          $sql = "UPDATE patients SET pFirstName = '".$_POST['updateFirstName']."', pLastName = '".$_POST['updateLastName']."', pName = '".$patientName."',status = '".$patientStatus."', statusImmediate = '".$statusImmediate."' , pCondition = '".$_POST['updatePatientCondition']."', age = '".$_POST['updateAge']."', gender = '".$patientGender."', mobile = '".$_POST['updateMobile']."', address = '".$_POST['updateAddress']."', Beacon_ID = null WHERE P_ID = '".$_POST['updateBtn_P_ID']."'";
        }else{
          $sql = "UPDATE patients SET pFirstName = '".$_POST['updateFirstName']."', pLastName = '".$_POST['updateLastName']."', pName = '".$patientName."',status = '".$patientStatus."', statusImmediate = '".$statusImmediate."' , pCondition = '".$_POST['updatePatientCondition']."', age = '".$_POST['updateAge']."', gender = '".$patientGender."', mobile = '".$_POST['updateMobile']."', address = '".$_POST['updateAddress']."', Beacon_ID = '".$_POST['updateBeacon_ID']. "' WHERE P_ID = '".$_POST['updateBtn_P_ID']."'";
        }
        
        $result = $db->query($sql);

                    //print "</br>".$_POST['updateType'];
        if(count($result) != 0){
              header('Location: patientlist.php');
            }
         }

    if(isset($_POST['removeBtn_P_ID'])){
         $sql = "DELETE FROM patients WHERE P_ID = '".$_POST['removeBtn_P_ID']."'";
                    //print $sql;
         $result = $db->query($sql);

         $sql2 = "DELETE FROM tempbeacons_patients WHERE p_id = '".$_POST['removeBtn_P_ID']."'";

         $result2 = $db->query($sql2);
                    //print "</br>".$_POST['updateType'];
         if(count($result) != 0){

           header('Location: patientlist.php');
          }
    }

    if(isset($_POST['addBtn'])){
    
        //print $_POST['addBtn'];                 
        $sqlI_Name = "SELECT name FROM incidents where I_ID = '".htmlspecialchars($_POST['addBtn'])."'";
        $resultI_Name = $db->query($sqlI_Name);
        $I_Name = "";
        if(count($resultI_Name) != 0 ){
            foreach ($resultI_Name as $row) {
                $I_Name = $row['name'];
          }
        }
        //print $I_Name;
        $statusImmediate = "";
        if($_POST['select_status'] == "IMMEDIATE"){
          if($_POST['select_respirations'] == "None" && $_POST['select_perfusion'] == "None" && $_POST['select_mentalStatus'] == "None"){
            $statusImmediate = "None";
          }else if ($_POST['select_respirations'] == "None" && $_POST['select_perfusion'] == "None") {
            $statusImmediate = $_POST['select_mentalStatus'];
          }else if ($_POST['select_respirations'] == "None" && $_POST['select_mentalStatus'] == "None") {
            $statusImmediate = $_POST['select_perfusion'];
          }else if ($_POST['select_mentalStatus'] == "None" && $_POST['select_perfusion'] == "None") {
            $statusImmediate = $_POST['select_respirations'];
          }else if ($_POST['select_respirations'] == "None" ) {
            $statusImmediate = $_POST['select_perfusion'] . "/" . $_POST['select_mentalStatus'];
          }else if ($_POST['select_mentalStatus'] == "None" ) {
            $statusImmediate = $_POST['select_respirations'] . "/" . $_POST['select_perfusion'];
          }else if ($_POST['select_perfusion'] == "None" ) {
            $statusImmediate = $_POST['select_respirations'] . "/" . $_POST['select_mentalStatus'];
          }else{
            $statusImmediate = $_POST['select_respirations'] . "/" . $_POST['select_perfusion'] . "/" . $_POST['select_mentalStatus'];
          }
        }else if($_POST['select_status'] == "MORGUE"){
          $statusImmediate = "None";
        }else if($_POST['select_status'] == "DELAYED"){
          $statusImmediate = "None";
        }else if($_POST['select_status'] == "MINOR"){
          $statusImmediate = "None";
        }else{
          $statusImmediate = "None";
        }

        $patientStatus = "";
        if($_POST['select_status'] == null || $_POST['select_status'] == ""){
          $patientStatus = "Unknown";
        }else{
          $patientStatus = $_POST['select_status'];
        }
        
         //print $statusImmediate;
        //print $statusImmediate;
        $patientGender = "";
        if($_POST['select_gender'] == "default"){
          $patientGender = "Unknown";
        }else{
          $patientGender = $_POST['select_gender'];
        }

        $patientName = $_POST['addFirstName']. " " . $_POST['addLastName'];

        $sql = "INSERT INTO patients(I_ID, incidentName, pFirstName, pLastName, pName, age, gender, status, statusImmediate, pCondition, address, mobile, Beacon_ID)
              VALUES('".htmlspecialchars($_POST['addBtn'])."', '".htmlspecialchars($I_Name)."', '".htmlspecialchars($_POST['addFirstName'])."', '".htmlspecialchars($_POST['addLastName'])."', 
                '".htmlspecialchars($patientName)."', '".htmlspecialchars($_POST['addAge'])."', '".htmlspecialchars($patientGender)."', '".htmlspecialchars($patientStatus)."', 
                '".htmlspecialchars($statusImmediate)."','".htmlspecialchars($_POST['addPatientCondition'])."', '".htmlspecialchars($_POST['addAddress'])."', '".htmlspecialchars($_POST['addMobile'])."', '".htmlspecialchars($_POST['addBeacon'])."')";
        // echo $sql;
         $result = $db->query($sql);
          //print "</br>".$_POST['addBtn'];
         if(count($result) != 0){

           header('Location: patientlist.php');
          }
        }

    
?>