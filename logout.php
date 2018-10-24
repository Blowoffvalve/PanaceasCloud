<?php
if(session_start()){

	require 'dbConnection.php';
	require 'serverSettings.php';
	if(file_exists($PanaceaServer["wordpressInstall"].'wp-load.php') && $_SESSION['wordpress']) { // Check if Wordpress is installed and user from Wordpress
		include_once($PanaceaServer["wordpressInstall"].'wp-load.php');
		wp_logout();
		$redirectToWP = true;
	} else $redirectToWP = false;

	// Unset all of the session variables.
	$_SESSION = array();
	//kill the session and delete all the session cookies.
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	}
    //destroy the session
	session_destroy();
	if($redirectToWP) wp_redirect( home_url() );
	else header("Location: login.php");
}



?>