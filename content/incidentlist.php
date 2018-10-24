
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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Panacea's Glass" content="">
    <meta name="Mark Vassell and Olivia Apperson" content="">

    <title>Edit Incidents Template</title>

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
      <script src="http://code.jquery.com/jquery.latest.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
        <h1>List of Incidents</h1>
      </div>
      
  <div class="modal-body">
          <div class="con">         
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Edit</th>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  require 'dbConnection.php';
                  $sql = "SELECT * FROM Incidents ORDER BY I_ID DESC";
                  $result = $db->query($sql);
                  if($result){
                    while($row = $result->fetch_assoc()){
                      $form = "<form method= 'POST' action='update_incidents.php'/>";
                      $form .= "<tr><td><button type='submit' value = '".$row['I_ID']."'class='btn btn-primary btn-lg btn-block' name='edit'><span class='glyphicon glyphicon-pencil'></span>Edit</button>";
                      $form .= "<button type='submit' value = '".$row['I_ID']."'class='btn btn-danger btn-lg btn-block' name='delete'><span class='glyphicon glyphicon-trash'></span>Archive/Remove</button></td>";
                      $form .= "<td>".$row['I_ID']."</td><td>".$row['type']."</td><td>".$row['name']."</td><td>".$row['description'].
                      "</td><td>".$row['status']."</td><td>".$row['time']."</td></tr>";
                      echo $form;
                    }
                  }


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




