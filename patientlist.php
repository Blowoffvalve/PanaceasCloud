
<?php
  session_start();
                    $_SESSION['data'] = $_POST['query_string'];
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    // if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
                    //     $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                    //     header("Location: $redirect");
                    // }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Panacea's Glass" content="">
    <meta name="Mark Vassell and Olivia Apperson" content="">

    <title>View Patients</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

      <script script type="text/javascript" src="js/sorttable/sorttable.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      th{
        text-align: center;
      }
      .red{
        color: red;
      }
      .yellow{
        color: orange;
      }
      .green{
        color: green;
      }
      .black{
        color: black;
      }
      .blue{
        color: blue;
      }

      table.sortable th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
        content: " \25B4\25BE" 
    }
    </style>

</head>

<body>

    <div id="wrapper">
        <?php
            require 'navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
        <div id = "title3">
        <h1>View Patients</h1>
        <ol class="breadcrumb">
            <li>
            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
            <span class='glyphicon glyphicon-eye-open'></span> View Patients
            </li>
        </ol>
      </div>
      
  <div class="modal-body">
    <div class="row">
            <div class="panel panel-primary">
                <div class="panel-body">
                  <?php (isset($_POST["search_by"])) ? $query = $_POST["search_by"] : $query='status';?>
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                      <div class='form-group'>
                      <label class="col-md-2 control-label">Filter by:</label>
                          <div class="col-md-12">
        
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'I_ID' ) echo "checked ='true' "; ?> value='I_ID'>Incident ID
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'incidentName' ) echo "checked ='true' "; ?> value='incidentName'>Incident Name
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'P_ID' ) echo "checked ='true' "; ?> value='P_ID'>Patient ID
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'pName' ) echo "checked ='true' "; ?> value='pFirstName'>First Name
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'pName' ) echo "checked ='true' "; ?> value='pFirstName'>Last Name
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'status' ) echo "checked ='true' "; ?> value='status'>Patient Status
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'pCondition' ) echo "checked ='true' "; ?> value='pCondition'>Patient Narrative
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'age' ) echo "checked ='true' "; ?> value='age'>Age
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='search_by' <?php if ($query == 'gender' ) echo "checked ='true' "; ?> value='gender'>Gender
                                </label>

                           </div>
                         </div>
                        
                        

                        <div class='form-group'>
                        <label class="col-md-2 control-label">Key Words:</label>
                          <div class="col-md-12">
                                <input type="text" name="query_string" class = "form-control" placeholder = 'You can input some key words to search here' value='<?php echo $_SESSION['data'];?>' ></br>
                           </div>
                           
                        </div>
                        <div class='form-group'>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-info" name="submit">
                                    <span class="glyphicon glyphicon-search"></span> Search
                            </button>
                           </div>
                         </div>
                  </form>
                </div><!-- panel body-->
            </div>
          <!-- </div> -->
        </div><!-- row-->

        <div class = "row">
          <form method="POST" action="patientlist_refresh.php">
            <button type="submit" class="btn btn-primary" name="defaultOrderSubmit" value= "defaultOrder">
              <span class="glyphicon glyphicon-th-list"></span> Default Order
            </button>
            <button type="submit" class="btn btn-primary" name="returnMapSubmit" value= "returnMapSubmit" style="float: right;">
              <span class="glyphicon glyphicon-map-marker"></span> Return Map
            </button>
          </form>
        </div>
        </br>

        <div class = "row">
          <div class="con">         
            <table class="table table-bordered sortable">
              <thead>
                <tr>
                  <th class="sorttable_nosort">Edit</th>
                  <th class="sorttable_nosort">Delete</th>
                  <th>I_ID</th>
                  <th>Incident Name</th>
                  <th>P_ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Status</th>
                  <th>Patient Narrative</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Beacon Id</th>
                </tr>
              </thead>
              
            <tbody>
              <div id = "patientModalUl" style="display: none;" >
                <?php
                  require 'showPatientlistTable.php';
                ?>
              </div>            
            </tbody>

            </table>
              
            
          </div>
        </div>
        <!-- start Modal -->
          <!-- 模态框（Modal） -->
             

           </div>
      </div>
      
    </div>
  </div>
    <!-- Modal -->
    <?php
      require 'dbConnection.php';
      $sql = "SELECT * FROM patients ORDER BY P_ID DESC";
      $result = $db->query($sql);

      if(count($result) != 0 ){
          foreach ($result as $row) {
            //(isset($_POST["select_by"])) ? $query = $_POST["select_by"] : $query='Status';
            $editPatientPart1 = "<div class='modal fade' id='editP_".$row['P_ID']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                        &times;
                                  </button>
                                  <h4 class='modal-title' id='myModalLabel'>
                                     Edit Selected Patient
                                  </h4>
                               </div>
                            <div class='modal-body'>
                              <form class='form-horizontal' role='form' method = 'POST' action = 'patientlist_refresh.php' id = 'patientForm' name = 'patientForm'>
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
                                      <input class='form-control' type='input' name='updateFirstName' value='".$row['pFirstName']."'>
                                    </div>
                                    <label class='col-sm-2 control-label'>Last Name:</label>
                                    <div class='col-sm-3'>
                                      <input class='form-control' type='input' name='updateLastName' value='".$row['pLastName']."'>
                                    </div>
          
                                </div>

                                <div class='form-group'>
                                    <label for='inputAge' class='col-sm-2 control-label'>Age:</label>
                                      <div class='col-sm-2'>
                                      <input type='text' class='form-control' id='inputAge' name = 'updateAge'
                                         value='".$row['age']."'>
                                    </div>
                                    <label class='col-sm-2 control-label'>Gender:</label>
                                    <div class='col-sm-3'>
                                      <select class='form-control' id='select_gender' name='select_gender' >
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
                                            <input type='radio' name='select_status' value='MORGUE' ";

                                  echo $editPatientPart5;
                                  if(isset($row['status']) && $row['status'] == "MORGUE")
                                    echo "checked";

                                $editPatientPart6 = "><font color = 'black'>MORGUE</font>
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' name='select_status' value='IMMEDIATE'";
                                  echo $editPatientPart6;
                                  if(isset($row['status']) && $row['status'] == "IMMEDIATE")
                                    echo "checked";

                                $editPatientPart7 =
                                            "><font color = 'red'>IMMEDIATE</font>
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' name='select_status' value='DELAYED' ";
                                    echo $editPatientPart7;
                                  if(isset($row['status']) && $row['status'] == "DELAYED")
                                    echo "checked";

                                $editPatientPart8 = "><font color = 'orange'>DELAYED</font>
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' name='select_status' value='MINOR'";
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
                                        <input type='radio' name='select_respirations' value='R' ";
                                echo $editPatientPart9;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "R") !== false)
                                    echo "checked";
                                $editPatientPart10 = ">Over 30 Seconds
                                      </label>
                                      <label class='radio-inline'>
                                        <input type='radio' name='select_respirations' value='None' ";
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
                                        <input type='radio' name='select_perfusion' value='P' ";
                                echo $editPatientPart11;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "P") !== false)
                                    echo "checked";
                                $editPatientPart12 = ">Capillary Refill Over 2 Seconds
                                      </label>
                                      <label class='radio-inline'>
                                        <input type='radio' name='select_perfusion' value='None' ";
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
                                        <input type='radio' name='select_mentalStatus' value='M' ";
                                echo $editPatientPart13;

                                if(isset($row['statusImmediate']) && strrpos($row['statusImmediate'], "M") !== false )
                                    echo "checked";
                                $editPatientPart14 = ">Unable to Follow Simple Commands
                                      </label>
                                     
                                      <label class='radio-inline'>
                                        <input type='radio' name='select_mentalStatus' value='None' ";
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
                                      <textarea class='form-control' name = 'updatePatientCondition' rows='3' id='inputPatientCondition' >".$row['pCondition']."</textarea>
                                    </div>
                                  </div>

                                  <div class='form-group'>
                                          <label class='col-sm-2 control-label'>Tracking Beacon:</label>
                                          <div class='col-sm-5'>
                                              <select class='form-control' name='updateBeacon_ID'> ";
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
                                  <button type='button' class='btn btn-primary' data-dismiss='modal'>
                                    Cancel
                                  </button>
                                  <button type='submit' class='btn btn-primary' value = '".$row['P_ID']."' name='updateBtn_P_ID'>
                                     Update
                                  </button>
                               </div>
                               </form>
                            </div>
                      </div>
                </div> "; 
                echo $secondPart;
              }
            }
      ?>
<!-- END UPDATE -->
      <?php
      require 'dbConnection.php';
      $sql = "SELECT P_ID FROM patients";
      $result = $db->query($sql);

      if(count($result) != 0 ){
          foreach ($result as $row) {
            //(isset($_POST["select_by"])) ? $query = $_POST["select_by"] : $query='Status';
            $removePatient = "<div class='modal fade' id='removeP_".$row['P_ID']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                        &times;
                                  </button>
                                  <h4 class='modal-title' id='myModalLabel'>
                                     Remove Selected Patient
                                  </h4>
                               </div>
                            <div class='modal-body'>
                                
                              <p><span class='glyphicon glyphicon-warning-sign'></span>WARNING!</p>
                              <p>Do you make sure to remove the selected Patient (patient id: ".$row['P_ID'].")? </p>         
                              <p>If removed, you can not recover the data!</p>                               

                            </div>
                               <div class='modal-footer'>
                               <form class='form-horizontal' role='form' method = 'POST' action = 'patientlist_refresh.php' id = 'patientForm' name = 'patientForm'>
                                  <button type='button' class='btn btn-primary' data-dismiss='modal'>
                                    Cancle
                                  </button>
                                  <button type='submit' class='btn btn-danger' value = '".$row['P_ID']."'name='removeBtn_P_ID'>
                                     Remove
                                  </button>
                               </div>
                               </form>
                            </div>
                      </div>
                </div> "; 
                echo $removePatient;
              }
            }
      ?>
        <!-- end Modal -->
      <script>
        var patientId = "<?php echo $passingData ?>";
        var modalId = "#editP_" + patientId;
        // alert(modalId);
        $(modalId).modal('show');
        // var mydata = div.textContent;
        // alert(div.id);
      </script>

  
  

</body>

  
</html>