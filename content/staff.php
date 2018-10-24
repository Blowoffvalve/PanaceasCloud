
<?php
  session_start();
                    $_SESSION['data'] = $_POST['query_string'];
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
                        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        header("Location: $redirect");
                    }
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Panacea's Glass" content="">
    <meta name="Mark Vassell and Olivia Apperson" content="">

    <title>Staff</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="../css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      

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
    </style>

</head>

<body>

    <div id="wrapper">
        <?php
            require '../content/navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
        <div id = "title3">
          <h1>Staff</h1>
        </div>
        <div>
          <?php
              (isset($_POST["search_by"])) ? $query = $_POST["search_by"] : $query='Email';
          ?>
          <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
              <p>Search by :
              <label class="radio-inline">
                <input type="radio" name="search_by" <?php if ($query == 'Status' ) echo "checked ='true' "; ?> value="Status"  />Status
              </label>
              <label class="radio-inline">
                <input type="radio" name="search_by" <?php if ($query == 'First_Name' ) echo "checked ='true' "; ?> value="First_Name"  />First Name 
              </label>
              <label class="radio-inline">
                <input type="radio" name="search_by" <?php if ($query == 'Last_Name' ) echo "checked ='true' "; ?> value="Last_Name"  />Last Name
              </label>
              <label class="radio-inline">
                <input type="radio" name="search_by" <?php if ($query == 'Email' ) echo "checked ='true' "; ?> value="Email"  />Email 
              </label>
              <label class="radio-inline">
                <input type="radio" name="search_by" <?php if ($query == 'Telephone' ) echo "checked ='true' "; ?> value="Telephone"  />Telephone
              </lable>
              <label class="radio-inline">
                <input type="radio" name="search_by" <?php if ($query == 'Job' ) echo "checked ='true' "; ?> value="Job"  />Job
              </label>
              <label class="radio-inline">
                <input type="radio" name="search_by" <?php if ($query == 'Glass_User' ) echo "checked ='true' "; ?> value="Glass_User"  />Glass User
              </label>
              <div>
                That contains the string:</p> <input type="text" name="query_string" class = "form-control:focus" placeholder = 'Search here' value="<?php echo $_SESSION['data'];?>" /> <br /><br />
                <button type="submit" class="btn btn-info" name="submit">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
              </div>
          </form>
      </div>

      
       <div class="row">
          <div class="col-lg-12">       
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Edit</th>
                  <th>Status</span></th>
                  <th>ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Telephone</th>
                  <th>Job</th>
                  <th>Glass User</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  require '../dbConnection.php';
                  $type = htmlspecialchars($_POST['search_by']);
                  $query_string = htmlspecialchars($_POST['query_string']);
                  $query_string = '%'.$query_string. '%';
                  switch ($type) {
                      case "First_Name":
                          require 'type.php';
                          break;
                      case "Last_Name":
                          // prepare and bind
                          require 'type.php';
                          break;
                      case "Email":
                          // prepare and bind
                          require 'type.php';
                          break;
                      case "Telephone":
                          // prepare and bind
                          require 'type.php';
                          break;
                      case "Job":
                          require 'type.php';
                          break;
                      case "Glass_User":
                          require 'type.php';
                          break;
                      case "Status":
                          require 'type.php';
                          break;
                      default:
                          $sql = "SELECT * FROM staff ORDER BY First_Name";
                          $result = $dbcon->query($sql);
                          $num_rows = $result->fetchColumn();
                          if ($num_rows> 0) {
                            // output data of each row
                            foreach($dbcon->query($sql) as $row) {
                              $form = "<form method= 'POST' action='update_info.php'/>\n";
                              $form .= "<button type='submit' class='btn btn-primary btn-lg btn-block' value = '".$row['ID']."'name='edit'><span class='glyphicon glyphicon-pencil'></span> Edit Status</button>";
                              if ($row['Status'] == 'Available'){
                                $color = 'green';
                              }else if ($row['Status'] == 'On Call'){
                                $color = 'yellow';
                              }else{
                                $color = 'red';
                              }
                              
                              echo "<tr><td>".$form."</td><td class = '".$color."'>".$row["Status"]."</td><td>" . $row["ID"]. "</td><td>" . $row["First_Name"]. "</td><td>" .$row["Last_Name"]. "</td><td>".$row["Email"]."</td><td>"
                              .$row["Telephone"]."</td><td>".$row["Job"]."</td><td>".$row["Glass_User"]."</td></tr><br>";
                            }
                            } else {
                              echo "0 results";
                            }
                  }
                  $dbcon->close;
                ?>
              </tbody>
            </table>
          </div>

        </div>
        
      </div>
      
    </div>
  </div>
  
  <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
                <!-- /.row -->




</body>

  
</html>




