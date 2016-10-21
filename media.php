<?php
include("database.php");

	function endswith($string, $test) {
    	$strlen = strlen($string);
    	$testlen = strlen($test);
    	if ($testlen > $strlen) return false;
    	return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
	}

$result = $conn->query("SELECT * from `posts` where `id` = '".$_GET['id']."'");
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();



	$filename=$row["filename"];
	$posttype=$row["posttype"];
	$filedata=$row['filedata'];
	$filecaption=$row['caption'];
	$fileid=$row['id'];
	$filesize=strlen($filedata);
	if(endswith($filename,".mp3")){

		header("Content-Type: audio/mpeg");
	    header('Content-Length: '.$filesize);
	    header('Accept-Ranges: bytes');
	    header ("Content-Range: bytes 0-" . $filesize - 1 . "/" . $filesize );
	    header('X-Pad: avoid browser bug');
		header('Cache-Control: no-cache');
	}else if(endswith($filename,".png")||endswith($filename,".jpg")){
		//do something with image resizeing, like if it's greater than max size, serve it smaller so the webpage doesnt take as long
		header("Content-Type: image/png,image/jepg");
	    header('Content-Length: '.$filesize);
	}

	if($posttype=="post"){
		$filename=$fileid.".txt";
		$filedata=$filecaption;
	}

	if(isset($_GET["download"])){
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . $filename . "\""); 
	}
	echo $filedata;
	exit();

	//flush();
}

