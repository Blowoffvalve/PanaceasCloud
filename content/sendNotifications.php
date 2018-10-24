<?php


session_start();
require '../dbConnection.php';

$send_to = htmlspecialchars($_POST["send_to"]);
if ($send_to == 'All' ){
  foreach($_SESSION['log_users'] as $lu){
    $sender = $_SESSION['username'];
    $reciver = $lu['users'];
    $message = htmlspecialchars($_POST['messages']);
    $send_notification_sql = "insert into notifications (type,content, sender,receiver) values('Messages','".$message."','".$sender."','"."$reciver"."')";
    $result = $db->query($send_notification_sql);
   }                     
  }elseif ($send_to == 'Selected') {
    $sender = $_SESSION['username'];
    $reciver = htmlspecialchars($_POST['recipient-name']);
    $message = htmlspecialchars($_POST['messages']);
    $send_notification_sql = "insert into notifications (type,content, sender,receiver) values('Messages','".$message."','".$sender."','"."$reciver"."')";
    $result = $db->query($send_notification_sql);
  }
  if($result == TRUE){
      $referer = $_SERVER['HTTP_REFERER'];
      header("Location: notifications.php");
  }
?>