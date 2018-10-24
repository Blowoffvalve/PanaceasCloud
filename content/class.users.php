<?php


require_once('../content/ez_sql_core.php');

require_once('../content/ez_sql_mysql.php');

$mdb = new ezSQL_mysql('root', '0cpV1lm87J8m', 'panacea', '127.0.0.1');

class users{

private $user_id;
private $username;
private $password;
private $reg_ip;
private $email;
private $reg_date;
private $last_login;

}

//check whether the user is registered
function check_user($uname, $pword, $ip){
	global $mdb;
	$exist = $mdb->query("SELECT Username, Password, Registered_IP FROM users 
         WHERE Username='$uname' AND Password='$pword' AND Registered_IP='$ip'");
	return $exist;
}

//set the last login time
function set_last_login($uname){
	global $mdb;
	$mdb->query("UPDATE users SET Last_Login=NOW() WHERE Username='$uname'");
}

//set the user as active
function set_active($uname){
	global $mdb;
	$mdb->query("UPDATE users SET Active=1 WHERE Username='$uname'");
}
//set the user as unactive
function set_inactive($uname){
	global $mdb;
	$mdb->query("UPDATE users SET Active=0 WHERE Username='$uname'");
}

//check logged users
function check_active($uname){
	global $mdb;
	$active = $mdb->query("SELECT Username, Active FROM users WHERE Username='$uname' AND Active=1");
	return $active;
}



?>