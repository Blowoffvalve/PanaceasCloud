<?php

sleep(rand(2,4));
session_start();
require 'dbConnection.php';

$receiver = str_replace(' ', '', $_SESSION['username']);

$sql = "SELECT id, type, content, time , sender FROM notifications WHERE status = 1 and receiver ='".$receiver."' ORDER BY time DESC LIMIT 10";
$result = $db->query($sql);
foreach($db->query($sql) as $row) {

    echo "<div class=\"notification-body\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
                <p>New Message</p>
                <p id=\"receiver_name\">From: ".$row['sender']."</p>
                <p id=\"contents\">Content: ".$row['content'].".</p>
          </div>";
}

//echo("Hi! Have a random number: " . rand(1,10));
?>