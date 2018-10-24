<?php
	require 'dbConnection.php';
	if(isset($_POST['updateBtn_I_ID'])){
         $sql = "UPDATE incidents SET name = '".$_POST['updateName']."', type = '".$_POST['updateType']."', description = '".$_POST['updateDescription']."', mission_stmt = '".$_POST['updateMissionStatement']."', status = '".$_POST['select_by']."', time = '".$_POST['updateTime']."' WHERE I_ID = '".$_POST['updateBtn_I_ID']."'";
         $result = $db->query($sql);
                    //print "</br>".$_POST['updateType'];
         //print $sql;
          if(count($result) != 0){
                header('Location: incidentlist.php');
            	}
           }

    if(isset($_POST['removeBtn_I_ID'])){
         $sql = "DELETE FROM incidents WHERE I_ID = '".$_POST['removeBtn_I_ID']."'";
                    //print $sql;
         $result = $db->query($sql);

         $sqlPatient = "DELETE FROM patients WHERE I_ID = '".$_POST['removeBtn_I_ID']."'";
                    //print $sql;
         $resultPatient = $db->query($sqlPatient);
                    
         if(count($result) != 0 && count($resultPatient) != 0){

           header('Location: incidentlist.php');
          }
        }

    if(isset($_POST['createBtn'])){
         $sql = "INSERT INTO incidents(type, name, description, mission_stmt, status, time)
              VALUES('".htmlspecialchars($_POST['select_type'])."', '".htmlspecialchars($_POST['createName'])."', '".htmlspecialchars($_POST['createDescription'])."', '".htmlspecialchars($_POST['createMissionStatement'])."', '".htmlspecialchars($_POST['select_status'])."', '".htmlspecialchars($_POST['createTime'])."')";
         $result = $db->query($sql);
                    //print "</br>".$_POST['updateType'];
         if(count($result) != 0){

           header('Location: incidentlist.php');
          }
        }
?>