<?php           
    session_start();         
                    //checking if the user is logged in 
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
                        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        header("Location: $redirect");
                    }
                    require 'dbConnection.php';
                    $sql = "SELECT * FROM admin Where email = '".$_SESSION['email']."'";
                          $result = $db->query($sql);
                          if ($result->num_rows > 0) {
                            // output data of each row
                            $row = $result->fetch_assoc();
                            $_SESSION['username'] = $row['fname']." ".$row['lname'];
                        }
                    $db->close();
                    if(!$_SESSION['lat'] || !$_SESSION['long']){
                        $_SESSION['lat'] = 38.9514;
                        $_SESSION['long'] = -92.3283;
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
    <link rel="shortcut icon" href="favicon.ico">
    <style>
    .center{
        text-align: center;
    }
    </style>
    <title>Panacea's Template</title>

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

    <style>
      #map-canvas {
        position: relative;
        top: 0%;
        left: 25%;
        width: 500px;
        height: 700px;

      }
      #coordinates{
        position: relative;
        top: 0%;
        left:23%;
        height: auto;
        width: 50%;
      }
      .color{
        color: white;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: new google.maps.LatLng(<?php echo $_SESSION['lat']; ?>, <?php echo $_SESSION['long']; ?>),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
    <div id = "wrapper">
        <?php
            require 'navigation.php';
        ?>  
        <div id = 'coordinates'>
            <form method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>">
                <div class="form-group">
                    <label class = "color" for="lat">Latitude</label>
                    <input type="text" class="form-control" id="lat" name = "lat" placeholder="Enter Latitude">
                </div>

                <div class="form-group">
                    <label class = 'color' for="long">Longitude</label>
                    <input type="text" class="form-control" id="long" name = "long" placeholder="Enter longitude here">
                </div>
                <div>
                    <button type="submit" name = 'submit' class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
        <div>               
            <div id = "map-canvas"></div>
        </div>

    <div>
    <?php
        if($isset($_POST['submit'])){
            if (!is_numeric($_POST['lat'])||!is_numeric($_POST['long'])){
                echo "the input sections must contain numeric values";
            }
            if (is_numeric($_POST['lat'])){
                $_SESSION['lat'] = $_POST['lat'];
            }
            if(is_numeric($_POST['long'])){
                $_SESSION['long'] = $_POST['long'];
            }
        }

    ?>
    </div>
</body>
</html>