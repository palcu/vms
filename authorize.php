<?php
  require_once('constants.php');
	error_reporting(E_ALL);
	
	//Verify user and pw in database
	function valid_user($username,$password){
		//Query database
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "SELECT user_name,user_password FROM admin";
		$data = mysqli_query($dbc, $query);
		mysqli_close($dbc);

		//Cycle through users
		while ($row = mysqli_fetch_array($data)){
			if ($row['user_name']==$username && $row['user_password']==$password){
				return true;
			}
		}
		return false;
	}

	//Body
	if (!isset($_SERVER['PHP_AUTH_USER']) ||
	    !isset($_SERVER['PHP_AUTH_PW']) ||
			!valid_user($_SERVER['PHP_AUTH_USER'],md5($_SERVER['PHP_AUTH_PW']))){
			//Incorect
		header('HTTP/1.1 401 Unauthorize');
		header('WWW-Authenticate:Basic realm="'.$REALM.'"');
		exit('<h1>Europe Direct VMS</h1><br />Date de autentificare incorecte.');
	}
?>
