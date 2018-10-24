<?php
    require 'dbConnection.php';
    // echo($_POST['search_by']);
    $type = htmlspecialchars($_POST['search_by']);
    $query_string = htmlspecialchars($_POST['query_string']);
    $query_string = '%'.$query_string. '%';

    if($_GET['pid'] != ""){
       $type = "P_ID";
       $query_string = $_GET['pid'];
       $passingData = $query_string;
       // echo $passingData;
    }
    
    switch ($type) {
        case "P_ID":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient;  
              }
            }else{
              print "There is no patients.";
            }
            break;
        case "I_ID":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span>/button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient;  
              }
            }else{
              print "There is no patient.";
            }
            break;
        case "incidentName":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient;  
              }
            }else{
              print "There is no patient.";
            }
            break;
        case "pFirstName":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient;   
              }
            }else{
              print "There is no patient.";
            }
            break;
        case "pLastName":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient;   
              }
            }else{
              print "There is no patient.";
            }
            break;
        case "status":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient; 
              }
            }else{
              print "There is no patient.";
            }
            break;
        case "pCondition":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient;  
              }
            }else{
              print "There is no patient.";
            }
            break;
        case "age":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient;  
              }
            }else{
              print "There is no patient.";
            }
            break;
        case "gender":
            $sql = "SELECT * FROM patients WHERE ".$type." LIKE '".$query_string."' ORDER BY P_ID DESC";
            $result = $db->query($sql);
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn-block' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['p_ID']."'class='btn btn-danger btn-sm btn-block' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }

                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient; 
              }
            }else{
              print "There is no patient.";
            }
            break;
        default:
            $sql = "SELECT * FROM patients ORDER BY P_ID DESC";
            $result = $db->query($sql);
    
            if(count($result) != 0 ){
              foreach ($result as $row) {
                  
                  //$buttonId = $row['I_ID'];
                  
                  //$form = "<form method= 'POST' id = 'patientForm' name = 'patientForm' > ";
                  $viewPatient = ""; 
                  $viewPatient .= "<tr><td><button id = 'editPBtn' type='submit' value = '".$row['P_ID']."' class='btn btn-primary btn-sm btn' name='editPatient' data-toggle='modal' data-target='#editP_".$row['P_ID']."'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                  $viewPatient .= "<td><button id = 'removePBtn' type='submit' value = '".$row['P_ID']."'class='btn btn-danger btn-sm' name='removePatient' data-toggle='modal' data-target='#removeP_".$row['P_ID']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
                  $sortKey = "";
                  if ($row['status'] == 'MINOR'){
                    $color = 'green';
                    $sortKey = "2";
                    //print "yes";
                  }else if ($row['status'] == 'DELAYED'){
                    $color = 'yellow';
                    $sortKey = "1";
                  }else if ($row['status'] == 'IMMEDIATE'){
                    $color = 'red';
                    $sortKey = "0";
                  }else if ($row['status'] == 'MORGUE'){
                    $color = 'black';
                    $sortKey = "3";
                  }else{
                    $color = 'blue';
                    $sortKey = "4";
                  }
                  $beacon = "";
                  if($row['Beacon_ID'] == null || $row['Beacon_ID'] == ""){
                    $beacon = "Released";
                  }else{
                    $beacon = $row['Beacon_ID'];
                  }
                  

                  $viewPatient .= "<td>".$row['I_ID']."</td><td>".$row['incidentName']."</td><td>".$row['P_ID']."</td><td>".$row['pFirstName']."</td><td>".$row['pLastName']."</td><td class = '" .$color. "' sorttable_customkey='".$sortKey."'>".$row['status']."</td><td>".$row['pCondition']."</td><td>".$row['age']."</td><td>".$row['gender']."</td><td>".$beacon."</td></tr>";
                  echo $viewPatient; 
                  //echo $viewpatient;    
                  //echo $editpatient; 
                  //print "</br>" . "id = " . $_POST["edit"];
                }
              }else{
                print "There is no patient.";
              }

    }
    
                  
                 
?>