<?php 

//when dealing with username stuff convert it to lowercase because usernames can be capital or lowercase
//and it should not affect the website

function getProfpic($username){
	global $conn;
	$sql = "SELECT * from users where `username` = '".$username."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return "<img style='max-width:60px;max-height:60px;' src='/media.php?id=".$row["picurl"]."'><br> ";

	}

	return "whatttt";
}

function getProperty($username,$property){
	global $conn;
	$sql = "SELECT * from users where `username` = '".$username."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return json_decode($row["properties"],true)[$property];
	}
}

function followToggle($username){
	global $conn;
	$user=$_SESSION['username'];
	$followList="";

	
	$sql = "SELECT * from users where `username` = '".$username."' or `username` = '{$user}'";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		//if ($result->num_rows > 0) {
			
			echo "name: ".$row["username"]."==".$username."<br>";
		try{
		
			$currentUser=$row["username"];
			if((strtolower($row["username"])===strtolower($username))){
				echo "THING 1<br>";
			//	echo $currentUser;
				
				$properties =json_decode($row["properties"],true);

				if (in_array(strtolower($user), $properties["followers"])){
					unset($properties["followers"][array_search(strtolower($user),$properties["followers"])]); 
				}else{
					array_push($properties["followers"],strtolower($user));

				}
				$sqlNew ="UPDATE `Phylum`.`users` SET `properties`='".json_encode($properties)."' WHERE `username`='{$currentUser}'";
				$conn->query($sqlNew);
			}else{
				echo "THING 2<br>";
				echo $currentUser;
				$properties =json_decode($row["properties"],true);

				if (in_array(strtolower($username), $properties["following"])){
					unset($properties["following"][array_search(strtolower($username),$properties["following"])]); 
				}else{
					array_push($properties["following"],strtolower($username));

				}
				$sqlNew ="UPDATE `Phylum`.`users` SET `properties`='".json_encode($properties)."' WHERE `username`='{$currentUser}'";
				echo $sqlNew."<br>";
				$conn->query($sqlNew);

			}

		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		//}
		
	}

	//echo "<br>".json_encode($properties);
	
	
}




function getPost($postId){
	global $conn;

	$sql = "SELECT * FROM Phylum.posts where id = '{$postId}';";
	if ($result = $conn->query($sql)) {
		while ($row = $result->fetch_assoc()) {
		?>
		<div align="center" id="<?= $row["id"] ?>" class="boxContainer note <?=$row["posttype"]?>">
			<!--div class="boxTitle"><?php echo $row["user"] ?></div-->
			<div class="boxTitle" style="max-height:20px" >
				

				<?php 

					$ratings=json_decode($row["rating"]);
					$avgRating=0;
					if(count($ratings)>0){
						for($i=0;$i<count($ratings);$i++){
							$avgRating+=$ratings[$i];
						}
						$avgRating=round($avgRating/count($ratings));
					}
					//echo $avgRating;
					for($i=0;$i<$avgRating;$i++){
						echo "<img src='/images/star_full.png'>";
					}
					//echo $starsLeft;
					for($i=0;$i<(5-$avgRating);$i++){
						echo "<img src='/images/star_empty.png'>";
					}

				?>

				
			</div>
		
			<div class="boxContent">
				<div style="width:100%;" class="profileHeader" onClick="javascript:redirect('<?php echo "feed.php?user=".$row["user"] ?>')">
					<div style="float:left;width:70px"> 
						<?php echo getProfpic($row["user"]); ?>
					</div> 
					<div style="float:left;margin:0;padding:0;margin-top: -4px;"> 
						<h3><?php echo $row["user"]; ?> </h3>
						
						<?php if($row["posttype"]=="download"){ ?>
							<i style="font-size:12px">posted on <?php echo date("m/d/Y", $row["date"])?> at <?php echo date("g:i A", $row["date"])?> </i>
						<?php } else {?>
							<i>posted on <?php echo date("m/d/Y", $row["date"])?> at <?php echo date("g:i A", $row["date"])?> </i>
						<?php }?>

					</div> 
					<br><br><br>
				</div>
				<hr>

				<?php echo $row["caption"]; ?>

				
				
				<?php if($row["posttype"]=="media"){ ?>
					<?php  
						if(endswith($row["filename"],".mp3")){?>
							<br><br>
							<audio controls="controls">  
	   							<source style="position:absolute;bottom:0;" src="/media.php?id=<?php echo $row["id"]; ?>" />  
							</audio><br> 
					<?php }else if(endswith($row["filename"],".jpg")||endswith($row["filename"],".png")){?>	
							<br><br>
							<img style="max-width:30%;max-height:30%;" src="/media.php?id=<?php echo $row["id"]; ?>">			
					<?php } ?>
				<?php } else if($row["posttype"]=="download"){?>
					<br><br>
					<!-- something that says it's a download-->
					<i><b>Downlad <?=$row["filename"]?></b></i>
				<?php } ?>

			</div><br><br><br>

			<div class="boxContentBottom" >	
				<!--				
				<h4 style="bottom:-50%; left: 50%;margin-left: -50px;position:absolute;">Download now!</h4>-->
				<div style="padding:5px">
					<a class="boxlink" onclick="javascript:rate('<?= $row["id"] ?>')">Rate</a> ·
					<a class="boxlink">Comment</a> ·
					<a class="boxlink" onclick="javascript:download('<?= $row["id"] ?>')">Download</a>
				</div>
			</div>

		</div>

	<?php
			}
		}else{
			echo "This ain't a post bro";
		}	
	}



function followStatus($username){
	global $conn;
	$user=$_SESSION['username'];
	$followList="";

	$sql = "SELECT * from users where `username` = '".$username."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$properties =json_decode($row["properties"],true);

		if (in_array($user, $properties["followers"])){
			return "unfollow";
		}else{
			return "follow";

		}

		return "?";

		//array_push($a,"blue","yellow");

	}
}

?>

<script type="text/javascript">

	function changeColor(el){
		
	}

</script>