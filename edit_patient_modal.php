<?php
  require 'dbConnection.php';
  $sql = "SELECT * FROM patients ORDER BY P_ID DESC";
  $result = $db->query($sql);

  if(count($result) != 0 ){
      foreach ($result as $row) {
        //(isset($_POST["select_by"])) ? $query = $_POST["select_by"] : $query='Status';
        $editPatientPart1 = "<div class='modal fade'  data-backdrop='static' data-keyboard='false' name = 'editP_".$row['P_ID']."' id='editP_".$row['P_ID']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' aria-hidden='true' ng-click = 'detectModal(".$row['P_ID'].")'>
                                        &times;
                                  </button>
                                  <h4 class='modal-title' id='myModalLabel'>
                                     Edit Selected Patient
                                  </h4>
                               </div>
                            <div class='modal-body'>
                              <form class='form-horizontal' role='form' method = 'POST' action = 'patientlist_refresh.php' id = 'patientForm_".$row['P_ID']."' name = 'patientForm'>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'>P_ID:</label>
                                  <div class='col-sm-1'>
                                      <p class='form-control-static'>".$row['P_ID']."</p>
                                  </div>
                                  <label class='col-sm-2 control-label'>I_ID:</label>
                                  <div class='col-sm-1'>
                                      <p class='form-control-static'>".$row['I_ID']."</p>
                                  </div>
                                  <label class='col-sm-2 control-label'>Incident Name:</label>
                                  <div class='col-sm-3'>
                                      <p class='form-control-static'>".$row['incidentName']."</p>
                                  </div>
                                </div>

                                <div class='form-group'>
          
                                    <label class='col-sm-2 control-label'>First Name:</label>
                                    <div class='col-sm-3'>
                                      <input class='form-control' type='input' id = 'pFirstNameModal_".$row['P_ID']."' name='updateFirstName' value='".$row['pFirstName']."'>
                                    </div>
                                    <label class='col-sm-2 control-label'>Last Name:</label>
                                    <div class='col-sm-3'>
                                      <input class='form-control' type='input' id = 'pLastNameModal_".$row['P_ID']."' name='updateLastName' value='".$row['pLastName']."'>
                                    </div>
          
                                </div>

                                <div class='form-group'>
                                    <label for='inputAge' class='col-sm-2 control-label'>Age:</label>
                                      <div class='col-sm-2'>
                                      <input type='text' class='form-control' id='inputAge_".$row['P_ID']."' name = 'updateAge'
                                         value='".$row['age']."'>
                                    </div>
                                    <label class='col-sm-2 control-label'>Gender:</label>
                                    <div class='col-sm-3'>
                                      <select class='form-control' id='select_gender_".$row['P_ID']."' name='select_gender' >
                                          <option ";
                              echo $editPatientPart1;

                              if(isset($row['gender']) && $row['gender'] == "Unknown")
                                  echo "selected = 'selected'";

                              $editPatientPart2 = " value = 'default'>Select gender</option>
                                          <option ";
                              echo $editPatientPart2;

                              if(isset($row['gender']) && $row['gender'] == "Male")
                                  echo "selected = 'selected'";

                              $editPatientPart3 = ">Male</option>
                                          <option ";
                              echo $editPatientPart3;

                              if(isset($row['gender']) && $row['gender'] == "Female")
                                  echo "selected = 'selected'";
                              $editPatientPart4 = ">Female</option>
                                          <option ";
                              echo $editPatientPart4;

                              if(isset($row['gender']) && $row['gender'] == "Unspecified")
                                  echo "selected = 'selected'";

                              $editPatientPart5 = ">Unspecified</option>
                                      </select>
                                    </div>
                                  
                                </div>

                                  <div class='form-group'>
                                      <label for='inputStatus' class='col-sm-2 control-label'>Status:</label>
                                      <div class='col-sm-10'>
                                        <label class='radio-inline'>
                                            <input type='radio' id = 'select_status_".$row['P_ID']."' name='select_status_".$row['P_ID']."' value='MORGUE' ";

                                  echo $editPatientPart5;
                                  if(isset($row['status']) && $row['status'] == "MORGUE")
                                    echo "checked";

                                $editPatientPart6 = "><font color = 'black'>MORGUE</font>
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' id = 'select_status_".$row['P_ID']."' name='select_status_".$row['P_ID']."' value='IMMEDIATE'";
                                  echo $editPatientPart6;
                                  if(isset($row['status']) && $row['status'] == "IMMEDIATE")
                                    echo "checked";

                                $editPatientPart7 =
                                            "><font color = 'red'>IMMEDIATE</font>
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' id = 'select_status_".$row['P_ID']."' name='select_status_".$row['P_ID']."' value='DELAYED' ";
                                    echo $editPatientPart7;
                                  if(isset($row['status']) && $row['status'] == "DELAYED")
                                    echo "checked";

                                $editPatientPart8 = "><font color = 'orange'>DELAYED</font>
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' id = 'select_status_".$row['P_ID']."' name='select_status_".$row['P_ID']."' value='MINOR'";
                                    echo $editPatientPart8;
                                if(isset($row['status']) && $row['status'] == "MINOR")
                                    echo "checked";

                                $editPatientPart9 = "><font color = 'green'>MINOR</font>
                                        </label>
                                    </div>
                                  </div>

                                  <div class='form-group'>
                                    <label class='col-md-2 control-label'><font color = 'red'>IMMEDIATE</font>:</label>
                                    <div class='col-md-10'>
                                      <label class='col-md-3 control-label'>Respirations</label>
                                        <label class='radio-inline'>
                                        <input type='radio' id = 'select_respirations_".$row['P_ID']."' name='select_respirations_".$row['P_ID']."' value='R' ";
                                echo $editPatientPart9;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "R") !== false)
                                    echo "checked";
                                $editPatientPart10 = ">Over 30 Seconds
                                      </label>
                                      <label class='radio-inline'>
                                        <input type='radio' id = 'select_respirations_".$row['P_ID']."' name='select_respirations_".$row['P_ID']."' value='None' ";
                                echo $editPatientPart10;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "R") === false)
                                    echo "checked";
                                $editPatientPart11 =">None
                                      </label>
                                    </div>
                                    <label class='col-md-2 control-label'></label>
                                    <div class='col-md-10'>
                                      <label class='col-md-3 control-label'>Perfusion</label>
                                        <label class='radio-inline'>
                                        <input type='radio' id = 'select_perfusion_".$row['P_ID']."' name='select_perfusion_".$row['P_ID']."' value='P' ";
                                echo $editPatientPart11;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "P") !== false)
                                    echo "checked";
                                $editPatientPart12 = ">Capillary Refill Over 2 Seconds
                                      </label>
                                      <label class='radio-inline'>
                                        <input type='radio' id = 'select_perfusion_".$row['P_ID']."' name='select_perfusion_".$row['P_ID']."' value='None' ";
                                echo $editPatientPart12;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "P") === false)
                                    echo "checked";
                                $editPatientPart13 = ">None
                                      </label>
                                    </div>
                                     <label class='col-md-2 control-label'></label>
                                    <div class='col-md-10'>
                                      <label class='col-md-3 control-label'>Mental_Status</label>
                                        <label class='radio-inline'>
                                        <input type='radio' id = 'select_mentalStatus_".$row['P_ID']."' name='select_mentalStatus_".$row['P_ID']."' value='M' ";
                                echo $editPatientPart13;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "M") !== false )
                                    echo "checked";
                                $editPatientPart14 = ">Unable to Follow Simple Commands
                                      </label>
                                     
                                      <label class='radio-inline'>
                                        <input type='radio' id = 'select_mentalStatus_".$row['P_ID']."' name='select_mentalStatus_".$row['P_ID']."' value='None' ";
                                echo $editPatientPart14;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "M") === false)
                                    echo "checked";
                                $editPatientPart15 = ">None
                                      </label>
                                    </div>
                                    
                                  </div>



                                      <div class='form-group'>
                                          <label for='inputPatientCondition' class='col-sm-2 control-label'>Patient Narrative:</label>
                                          <div class='col-sm-10'>
                                          <textarea class='form-control' name = 'updatePatientCondition' rows='3' id='inputPatientCondition_".$row['P_ID']."' >".$row['pCondition']."</textarea>
                                        </div>
                                      </div>

                                      
                                      <div class='form-group'>
                                          <label class='col-sm-2 control-label'>Tracking Beacon:</label>
                                          <div class='col-sm-5'>
                                              <select class='form-control' id = 'updateBeacon_ID_".$row['P_ID']."' name='updateBeacon_ID'> ";
                                    echo $editPatientPart15;
                                     if($row['Beacon_ID'] != null){
                                        echo "<option value ='".$row['Beacon_ID']."''>".$row['Beacon_ID']."</option>";
                                        echo "<option value='0'>Released</option>";
                                      }else{
                                        echo "<option value='0'>Released</option>";
                                      }
                                    $sql1 = "SELECT id FROM beacons where id NOT IN (SELECT Beacon_ID FROM patients WHERE Beacon_ID is not null)";
                                      $result1 = $db->query($sql1);
                                      if(count($result1) != 0 ){
                                        foreach ($result1 as $row1) {
                                          echo "<option value ='".$row1['id']."'>".$row1['id']."</option>";
                                        }
                                      }

                                              $secondPart = "                                                
                                              </select>
                                          </div>
                                      </div>
                           </div>
                           <div class='modal-footer'>
                              <button type='button' class='btn btn-primary' ng-click = 'detectModal(".$row['P_ID'].")'>
                                Cancel
                              </button>
                              <button type='submit' class='btn btn-primary' value = '".$row['P_ID']."' name='updateBtn_P_ID_map'>
                                 Update
                              </button>
                           </div>
                           </form>
                        </div>
                  </div>
            </div> "; 
            
            echo $secondPart;


            $thirdPart = "<div data-backdrop='static' data-keyboard='false' name = 'confirmP_".$row['P_ID']."' id='confirmP_".$row['P_ID']."' class='modal fade'>
                          <div class='modal-dialog'>
                              <div class='modal-content'>
                                  <div class='modal-header'>
                                      <button type='button' class='close' data-dismiss='modal' aria-hidden='true' onclick='closeModal(".$row['P_ID'].")'>&times;</button>
                                      <h4 class='modal-title'>Confirmation</h4>
                                  </div>
                                  <div class='modal-body'>
                                      <p>Do you want to close without saving changes?</p>
                                      <p class='text-warning'><small>If you don't save, your changes will be lost.</small></p>
                                  </div>
                                  <div class='modal-footer'>
                                      <button type='button' class='btn btn-default' onclick='closeModal(".$row['P_ID'].")'>Close</button>
                                      <button type='button' class='btn btn-primary' onclick='saveChanges(".$row['P_ID'].")'>Save changes</button>
                                  </div>
                              </div>
                          </div>
                      </div>";
            echo $thirdPart;
          }
        }
  ?>
