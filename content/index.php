<?php           
   require 'initial.php';
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
    function addNotification(msg){
        /* Simple helper to add a div.
        type is the name of a CSS class (old/new/error).
        msg is the contents of the div */
        $("#slide-bottom-popup").append(msg);
        $('#slide-bottom-popup').modal('show');
    }
    function allertMessage(){
        // $('#contents').text("Content: 111111");  
    }

    function waitForMsg(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "GET",
            url: "getMessages.php",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:5000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                
                addmsg("new", data); 
                setTimeout(
                    waitForMsg, /* Request next message */
                    1000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                //addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    waitForMsg, /* Try again after.. */
                    15000); /* milliseconds (15seconds) */
            }
        });
    };
    function waitForNotification(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "GET",
            url: "getNotifications.php",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:5000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                if(data != ""){
                    addNotification(data);
                    $.ajax({
                        type: "GET",
                        url: "getMessages.php",
                        success:function(data1){
                            addmsg("new", data1); 
                        },
                        error: function(){

                        }
                    });
                }
                setTimeout(
                    waitForNotification, /* Request next message */
                    1000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                //addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    waitForNotification, /* Try again after.. */
                    15000); /* milliseconds (15seconds) */
            }
        });
    };

    $(document).ready(function(){
        waitForNotification();
        //waitForMsg(); /* Start the inital request */
       
    });
    </script>
    <script type="text/javascript">


</script>

 <style>
 /*------------------------------------Pop-up styles-------------------------------------*/

.notification.fade.in .notification-body {
    bottom: 0; 
}
.notification-body {
    position: absolute;
    bottom: -250px;
    right: 1%;
    padding: 15px;
    width: 275px;
    height: 100px;
    background-color: #e5e5e5;
    border-radius: 6px 6px 0 0;
    -webkit-transition: bottom 0.3s ease-out;
    -moz-transition: bottom 0.3s ease-out;
    -o-transition: bottom 0.3s ease-out;
    transition: bottom 0.3s ease-out;
}
.close {
    margin-top: -20px;
    text-shadow: 0 1px 0 #ffffff;
}
.popup-button {
    margin-left: 140px;
    margin-top: 77px;
    font-weight: bold;
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
                                        require '../dbConnection.php';
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
                                        require '../dbConnection.php';
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
                                    require '../dbConnection.php';
                                    $sql = "SELECT id, type, content, time, sender FROM notifications WHERE status = 0 and receiver = '".str_replace(' ', '', $_SESSION['username'])."'";
                                    $result = $db->query($sql);
                                    //echo "<div class=\"col-lg-6\">";
                                    //echo "<table class=\"table table-bordered table-hover table-striped\"><thead><tr><td>New Incidents</td><td>Date</td><td>Time</td></tr></thead><tbody>";

                                    foreach($dbcon->query($sql) as $row) {
                                        if(strlen($row['content']) <= 7){
                                             echo " <a href=#".$row['id']." data-toggle=\"modal\" class=\"list-group-item\">
                                        <span class=\"badge\">".$row['type']." ".$row['time']."</span>
                                        <i class=\"fa fa-fw fa-calendar\"></i> ".$row['content']."
                                    </a>";
                                        }else{
                                            echo " <a href=#".$row['id']." data-toggle=\"modal\" class=\"list-group-item\">
                                        <span class=\"badge\">".$row['type']." ".$row['time']."</span>
                                        <i class=\"fa fa-fw fa-calendar\"></i> ".substr($row['content'],0,7)."..
                                    </a>";
                                        }
                                      //echo "<tr><td>".$row['description']."</td><td>".$row['note_date']."</td><td>".$row['time']."</td></tr>";
                                        echo "<div class=\"modal fade\" id=".$row['id']." role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        
                                          <!-- Modal content-->
                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Message</h4>
                                            </div>
                                            <div class=\"modal-body\">
                                              <p>From: ".$row['sender'].".</p>
                                              <p>Content: ".$row['content'].".</p>
                                              <p>SentTime: ".$row['time'].".</p>
                                            </div>
                                            <div class=\"modal-footer\">
                                              <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>";
                                    }
                                    ?>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

  
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>
     <div class="notification fade" id="slide-bottom-popup" data-keyboard="false" data-backdrop="false">
           <!-- /.modal-body -->
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
