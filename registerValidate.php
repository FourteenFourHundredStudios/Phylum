<?php
	include_once("database.php");


	//when saving hash I put random number in database add it to password and hash that
	//when validating take random number add to password and hash and check if equal
	//implement $conn->real_escape_string()
	$username=strtolower($_GET['username']);
	if($_GET['password']==$_GET['passwordRepeat']){
		$json=json_encode(array("following" => array($username), "followers" => array()));
		$passwordSalt=rand();
		$sql = "INSERT INTO users (username,password_hash,password_salt,email,status,properties,picurl) VALUES ('".$username."', '".hash('sha256',$_GET['password'].$passwordSalt)."', '".$passwordSalt."', '".$_GET['email']."', 'standard','".$json."','0')";

		if(!(strlen($username)>5 && strlen($_GET['password'])>5 && strlen($_GET['email'])>5)){
			header( 'Location: register.php?error=The length of all fields needs to be greater than 5 characters' ) ;
			die();
		}

		if ($conn->query($sql) === TRUE) {
			header( 'Location: index.php' ) ;
			die();
		} else{
			header( 'Location: register.php?error=could not create account' ) ;
			die();
		}

	}else{
		header( 'Location: register.php?error=passwords do not match' ) ;
		die();
	}

?>