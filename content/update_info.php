
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
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update Status</title>

   <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="../css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
    <style>
        tr, th{
            text-align: center;
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php 
            require 'navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Status
                            <small>Edit</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="../index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            require 'dbConnection.php';
                            if (!isset($_POST["edit"])&& !isset($_POST["update"])){
                                Echo"Sorry You can't view this content <a href = 'staff.php'>go to the staff page</a>";
                            }else if(isset($_POST["edit"])){
                                $sql = "SELECT ID, First_Name, Last_Name, Status FROM staff WHERE ID = ".$_POST["edit"];
                                $result = $db->query($sql);
                                if ($result->num_rows){
                                    echo "<table class=\"table table-bordered\"><th colspan = \"2\">Update</th><tbody>";
                                    echo "<form method = 'POST' action = '".htmlspecialchars($_SERVER["PHP_SELF"])."'>";
                                    $row = $result->fetch_assoc();
                                        echo "<tr><td>ID</td><td>".$row["ID"]."</td></tr>";
                                        echo "<tr><td>First Name</td><td>".$row["First_Name"]."</td></tr>";
                                        echo "<tr><td>Last_Name</td><td>".$row["Last_Name"]."</td></tr>";
                                        echo "<tr><td>Status</td><td>              
                                            <label class=\"radio-inline\">
                                                <input type=\"radio\" name=\"search_by\" value=\"Available\"  />Available
                                            </lable>
                                            <label class=\"radio-inline\">
                                                <input type=\"radio\" name=\"search_by\" value=\"On Call\"  />On Call
                                            </label>
                                            <label class=\"radio-inline\">
                                                <input type=\"radio\" name=\"search_by\" value=\"Unavailable\"  />Unavailable
                                            </label>
                                            </td></tr>";
                                        echo "<input type = 'hidden' name = 'id' value = '".$row["ID"]."' />";
                                        echo"<tr><td colspan = \"2\"><input type = \"submit\" name = \"update\" value = \"update status\" class = \"btn btn-warning\"><td></tr>";
                                        

                                    echo"</tbody>";
                                    echo"</table>";  
                                    echo "</form>"; 

                                }

                            }else if (isset($_POST["update"])){
                                if(!isset($_POST["search_by"])){
                                    echo "Please make a status selection";
                                    exit (-1);
                                }
                                $sql = "UPDATE staff SET Status = '".$_POST['search_by']."' WHERE ID = ".$_POST['id'];
                                $result = $db->query($sql);
                                //echo $result;
                                if ($result === TRUE){
                                    echo "Update successful<a href = 'staff.php'> return to staff page</a>";
                                }
                            }

                        
                        $db->close();
                        ?>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
