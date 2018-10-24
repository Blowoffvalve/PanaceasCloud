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

function check_user($uname){
	global $mdb;
	$exist = $mdb->query("SELECT ID, First_Name, Last_Name FROM staff 
         WHERE First_Name='$uname'");
	return $exist;
}


?>