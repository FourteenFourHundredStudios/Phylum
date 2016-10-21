<?php

	include_once("database.php");
	
	$sql = "SELECT * from users where `username` = '".$_GET["username"]."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$passwordHash=$row["password_hash"];

		
		$suppliedHash=hash('sha256',$_GET["password"] . $row["password_salt"]);
		
		if($passwordHash==$suppliedHash){
			header('Location: feed.php'); 
			session_start();
			$_SESSION['username']=strtolower($_GET["username"]);
			$int = 60*60*60*60;
			setcookie("username",$_SESSION['username'],time()+$int);
			setcookie("password",$_GET["password"],time()+$int);

		}else{
			header('Location: index.php?error=Incorrect password') ;
			die();
		}

	}else{
		header('Location: index.php?error=Incorrect username') ;
		die();
	}

?>