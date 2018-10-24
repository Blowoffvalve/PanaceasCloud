<!DOCTYPE html>
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
<html>
  <head>
    <title>Notifications</title >
    
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

        <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
    <style>
    .error{
      color: red;
    }
    td {
    width: 1px;
    white-space: nowrap;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function () {
        console.log("document ready")
        $('#Selected').live('click', function () {
            $("#recipient-name").prop('readonly', false);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        console.log("document ready")
        $('#All').live('click', function () {
            $("#recipient-name").prop('readonly', true);
        });
    });
    
</script>
  </head>
  <body>
        <div id="wrapper">
        <?php
            require 'navigation.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Messages
                            
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> Messages
                            </li>
                        </ol>
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Send Message</button>
                        <p/>

                    </div>
                   
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action='sendNotifications.php'>
                          <div class="form-group">
                            <label for="recipient-name" class="control-label">Recipient:</label>
                            <?php
                              (isset($_POST["send_to"])) ? $send_to = $_POST["send_to"] : $send_to='Selected';
                            ?>
                            <label class="radio-inline">
                              <input type="radio" name="send_to" id="All" <?php if ($send_to == 'All' ) echo "checked ='true' "; ?> value="All"  />All
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="send_to" id="Selected" <?php if ($send_to == 'Selected' ) echo "checked ='true' "; ?> value="Selected" />Selected 
                            </label>
                            <input type="text" class="form-control" id="recipient-name" name="recipient-name"  list ="recipient"  >
                           
                            <datalist id="recipient"> 
                              <?php
                                  foreach($_SESSION['log_users'] as $lu){
                                    echo "<option value=".$lu['users']."></option>";
                                  }
                              ?> 
                            </datalist> 
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="control-label" >Message:</label>
                            <textarea class="form-control" id="message-text" name="messages"></textarea>
                          </div>
                           <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                      </div>
                        </form>
                      </div>
                     
                    </div>
                  </div>
                </div>
                    <?php
                    require 'dbConnection.php';
                    $sql = "SELECT id, type, content,time, sender,receiver FROM notifications  ORDER BY time DESC, time DESC";
                    $result = $db->query($sql);
                    echo "<div class=\"col-lg-6\" id=\"all-notifications\">";
                    echo "<table  class=\"table table-bordered table-hover table-striped\"><thead><tr><td>Detail</td><td>Sender</td><td>Receiver</td><td>Content</td><td>Time</td></tr></thead><tbody>";

                    foreach($db->query($sql) as $row){
                      if(strlen($row['content']) > 7){
                        echo "<tr class='odd gradeX'><td><button id = 'subBtn' type='submit' value = '".$row['id']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['id']."'>Detail</button></td>"
                        ."<td >".$row['sender']."</td><td>".$row['receiver']."</td><td>".substr($row['content'],0,15)."..</td><td>".$row['time']."</td></tr>";
                      }else{
                        echo "<tr class='odd gradeX'><td><button id = 'subBtn' type='submit' value = '".$row['id']."' class='btn btn-primary btn-sm btn-block' name='edit' data-toggle='modal' data-target='#edit_".$row['id']."'>Detail</button></td>"
                        ."<td >".$row['sender']."</td><td>".$row['receiver']."</td><td>".$row['content']."</td><td>".$row['time']."</td></tr>";
                      }
                      echo "<div class=\"modal fade\" id='edit_".$row['id']."' role=\"dialog\">
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
                          <!--end modal content -->
                        </div>
                      </div>";
                      
                    }
                    
                    $db->close();
                    ?>
                </div>
                
            </div>
          </div>
</body>
</html>

