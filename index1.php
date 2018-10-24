<?php           
   session_start();
                    
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <style>
      #map-canvas {
        width: 100%;
        height: 575px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: new google.maps.LatLng(38.9514, -92.3283),
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
     <script type="text/javascript" charset="utf-8">
    function addmsg(type, msg){
        /* Simple helper to add a div.
        type is the name of a CSS class (old/new/error).
        msg is the contents of the div */
        $("#list-group").append(msg);
    }

    function waitForMsg(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "GET",
            url: "msgsrv.php",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                addmsg("new", data); /* Add response to a .msg div (with the "new" class)*/
                setTimeout(
                    waitForMsg, /* Request next message */
                    1000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    waitForMsg, /* Try again after.. */
                    15000); /* milliseconds (15seconds) */
            }
        });
    };

    $(document).ready(function(){
        waitForMsg(); /* Start the inital request */
    });
    </script>

</head>

<body>

    <div id="wrapper">
        <?php
            require 'content/navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php
                                        require 'dbConnection.php';
                                        $sql ="SELECT * FROM Incidents";
                                        $result = $db->query($sql);
                                        echo $result->rowCount();

                                        ?></div>
                                        <div>New Incidents</div>
                                    </div>
                                </div>
                            </div>
                            <a href="incidentlist.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-stethoscope fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php
                                        require 'dbConnection.php';
                                        $sql ="SELECT * FROM staff";
                                        $result = $db->query($sql);
                                        echo $result->rowCount();
                                        ?></div>
                                        <div>Current Staff</div>
                                    </div>
                                </div>
                            </div>
                            <a href="staff.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Statuses</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-video-camera fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">2</div>
                                        <div>Glass Feeds</div>
                                    </div>
                                </div>
                            </div>
                            <a href="glass_streams.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Feeds</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Half</div>
                                        <div>Supplies</div>
                                    </div>
                                </div>
                            </div>
                            <a href="bloodbag.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Supplies</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
               

                    <div class="col-lg-8">
                       <div id = "map-canvas"></div>
                    </div>
                     <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Notifications</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group" id="list-group">
                                    <?php
                                    require 'dbConnection.php';
                                    $sql = "SELECT description, note_date, time FROM notifications WHERE status = 0 ORDER BY note_date DESC LIMIT 10";
                                    $result = $db->query($sql);
                                    //echo "<div class=\"col-lg-6\">";
                                    //echo "<table class=\"table table-bordered table-hover table-striped\"><thead><tr><td>New Incidents</td><td>Date</td><td>Time</td></tr></thead><tbody>";

                                    foreach($dbcon->query($sql) as $row) {
                                       echo " <a href=\"#\" class=\"list-group-item\">
                                        <span class=\"badge\">".$row['note_date']." ".$row['time']."</span>
                                        <i class=\"fa fa-fw fa-calendar\"></i> ".$row['description']."
                                    </a>";
                                      //echo "<tr><td>".$row['description']."</td><td>".$row['note_date']."</td><td>".$row['time']."</td></tr>";
                                    }
                                    ?>
                                    <!--<a href="#" class="list-group-item">
                                        <span class="badge">just now</span>
                                        <i class="fa fa-fw fa-calendar"></i> Ambulance arrived at University Hospital Building A
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">4 minutes ago</span>
                                        <i class="fa fa-fw fa-comment"></i> Incident 3 has escalated
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">23 minutes ago</span>
                                        <i class="fa fa-fw fa-truck"></i> Nurses needed for Incident 4
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">46 minutes ago</span>
                                        <i class="fa fa-fw fa-money"></i> Amublance ETA: 2 minutes
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> Dr. Smith sent to Incident 5
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">2 hours ago</span>
                                        <i class="fa fa-fw fa-check"></i> Fire has been put out
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Assistance needed at Incident 1
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">two days ago</span>
                                        <i class="fa fa-fw fa-check"></i> Ambulance ETA: 5 minutes
                                    </a>-->
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

    
                    <!--<div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-hospital-o fa-fw"></i> Facilities</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Facility</th>
                                                <th>Beds</th>
                                                <th>Blood Bags</th>
                                                <th>Nurses Active</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>University Hospital Building A</td>
                                                <td>10</td>
                                                <td>29</td>
                                                <td>33</td>
                                            </tr>
                                            <tr>
                                                <td>University Hospital Building B</td>
                                                <td>10</td>
                                                <td>20</td>
                                                <td>34</td>
                                            </tr>
                                            <tr>
                                                <td>University Hospital Building C</td>
                                                <td>10</td>
                                                <td>3</td>
                                                <td>17</td>
                                            </tr>
                                            <tr>
                                                <td>University Hospital Building D</td>
                                                <td>10</td>
                                                <td>3</td>
                                                <td>11</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="beds.php">View Facility Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>-->

                </div>
                <!-- /.row -->

  
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>
