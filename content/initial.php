<?php           
    session_start();         
                    function check_session($username){
                      foreach($_SESSION['log_users'] as $lu){
                        if(($lu['users']==$username)){
                          return 1;
                        }
                      }
                    }
                    $H = false;
                    if($_SESSION['status'] != 'true'){
                        header("Location: login.php");
                    }
                    if($H){
                        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        header("Location: $redirect");
                    }
                    require '../dbConnection.php';
                    $sql = "SELECT * FROM admin Where email = '".$_SESSION['email']."'";
                    $result = $db->query($sql);
                    $num_rows = $result->rowCount();
                    if($num_rows == 1){
                             foreach($dbcon->query($sql) as $row) {
                                $_SESSION['username'] = $row['fname']." ".$row['lname'];

                                if(check_session($row['fname'].$row['lname']) != 1){
                                  $_SESSION['log_users'][] = array('users'=>$row['fname'].$row['lname']);
                                }
                                
                            }
                           // header("Location: index.php");
                      }
?>