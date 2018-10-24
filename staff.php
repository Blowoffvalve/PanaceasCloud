
<?php
  session_start();
                    $_SESSION['data'] = $_POST['query_string'];
                    require 'serverSettings.php';
                    if($_SESSION['wordpress'] && file_exists($PanaceaServer["wordpressInstall"].'wp-load.php')) {
	                    include_once($PanaceaServer["wordpressInstall"].'wp-load.php');
	                    if(!is_user_logged_in() || wp_get_current_user()->user_email!=$_SESSION['email']) {
		                    header("Location: logout.php");
	                    }
	                }
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    
                    
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Staff</title >
    
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

    <!-- Bootstrap Core CSS -->
   <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
            <table class="table table-bordered sortable">
              <thead>
                <tr>
                  <th class="sorttable_nosort">Edit</th>
                  <th>Status</span></th>
                  <th>ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Telephone</th>
                  <th>Job</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  require 'dbConnection.php';
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
                          $sql = "SELECT * FROM tempstaffs ORDER BY First_Name";
                          $result = $db->query($sql);
                          if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              $form = "<form method= 'POST' action='update_info.php'/>\n";
                              $form .= "<button type='submit' class='btn btn-primary' value = '".$row['S_ID']."'name='edit'><span class='glyphicon glyphicon-pencil'></span></button>";
                              if ($row['Status'] == 'Available'){
                                $color = 'green';
                              }else if ($row['Status'] == 'On Call'){
                                $color = 'yellow';
                              }else{
                                $color = 'red';
                              }
                              
                              echo "<tr><td>".$form."</td><td class = '".$color."'>".$row["Status"]."</td><td>" . $row["S_ID"]. "</td><td>" . $row["First_Name"]. "</td><td>" .$row["Last_Name"]. "</td><td>".$row["Email"]."</td><td>"
                              .$row["Telephone"]."</td><td>".$row["Job"]."</td></tr><br>";
                            }
                            } else {
                              echo "0 results";
                            }
                  }
                  $db->close;

                ?>
              </tbody>
            </table>
          </div>

        </div>
        
      </div>
      
    </div>
  </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
                <!-- /.row -->




</body>

  
</html>

