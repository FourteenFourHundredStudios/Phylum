<body style="background:none transparent;">
</body>

<?php

	include_once('database.php'); 
	date_default_timezone_set('America/Chicago');
	session_start();
	if(!(isset($_SESSION['username']))){
		header('Location: index.php?error=You need to login to view this page') ;	
		die();	
	} 

	function endswith($string, $test) {
    	$strlen = strlen($string);
    	$testlen = strlen($test);
    	if ($testlen > $strlen) return false;
    	return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
	}

//	echo "File attached: ".empty($_FILES["userFile"]);

	if(empty($_FILES['userFile']['name'])){
		$date=getdate()[0];
		$postId=rand();
		$caption= $_POST['caption'];
		$sql="INSERT INTO `posts` (`date`, `user`, `caption`, `posttype`, `id`) VALUES ('{$date}', '{$_SESSION['username']}', '{$caption}', 'post', '{$postId}');";
		if ($conn->query($sql) === TRUE) {
			header( 'Location: feed.php' ) ;
			die();
		} else{
			//echo $sql;
			header( 'Location: error.php' ) ;
			die();
		}
	}else{
		try {
			$date=getdate()[0];
			$postId=rand();
			$filename=strtolower($_FILES['userFile']['name']);
			$type="media";
			if(!(endsWith($filename,".mp3")||endsWith($filename,".jpg")||endsWith($filename,".png")) ){
				$type="download";
			}

			$filedata=$conn->real_escape_string(file_get_contents($_FILES ['userFile']['tmp_name']));
			$caption= $_POST['caption'];
			echo $caption;
			//die();
			$sql=
				"INSERT INTO `posts` 
					(`date`, `user`, `caption`, `posttype`, `id`, `filename`, `filedata`) 
					VALUES 
					('{$date}', '{$_SESSION['username']}', '{$caption}', '{$type}', '{$postId}','{$filename}','{$filedata}');";
			if ($conn->query($sql) === TRUE) {
				header( 'Location: feed.php' ) ;
				die();
			} else{
				echo $conn->error;
				header( 'Location: error.php' ) ;
				die();
			}
		} catch (Exception $e) {
    		echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	//header("Location: feed.php");



