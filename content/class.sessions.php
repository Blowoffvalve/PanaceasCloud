<?php


//create the session contains the username and the ip address
function create_session($username, $ip){
	$_SESSION['log_users'][] = array('username'=>$username, 'ip'=>$ip);

}

//checks the session if it contains the username and the ip address of the current user
function check_session($username, $ip){
	
	foreach($_SESSION['log_users'] as $lu){
	
		if(($lu['username']==$username)&&($lu['ip']==$ip)){
			return 1;
		}
	}
}
// logs the user out of the system
function unset_session($uname){
	foreach($_SESSION['log_users'] as $id=>$lu){
	
		if($lu['username']==$username)){
			unset($_SESSION['log_users'][$id]);
		}
	}
}

?>