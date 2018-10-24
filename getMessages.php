<?php

session_start();
require 'dbConnection.php';

$receiver = str_replace(' ', '', $_SESSION['username']);

$sql = "SELECT id, type, content, time,sender FROM notifications WHERE status = 1 and receiver ='".$receiver."' ORDER BY time DESC LIMIT 10";
$result = $db->query($sql);
foreach($db->query($sql) as $row) {
  if(strlen($row['content']) > 7){
    echo " <a href=#".$row['id']." data-toggle=\"modal\" class=\"list-group-item\">
   <span class=\"badge\">".$row['type']." ".$row['time']."</span>
   <i class=\"fa fa-fw fa-calendar\"></i> ".substr($row['content'], 0,7)."..
   </a>";
  }else{
    echo " <a href=#".$row['id']." data-toggle=\"modal\" class=\"list-group-item\">
   <span class=\"badge\">".$row['type']." ".$row['time']."</span>
   <i class=\"fa fa-fw fa-calendar\"></i> ".$row['content']."
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
  $sql_update = "UPDATE notifications SET status = 0 WHERE id = ".$row['id'];
  $db->query($sql_update);
}

//echo("Hi! Have a random number: " . rand(1,10));
?>