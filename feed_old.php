
<title>Feed</title>
<?php 

include 'header.php';

//getPost("0");

function endswith($string, $test) {
   	$strlen = strlen($string);
   	$testlen = strlen($test);
   	if ($testlen > $strlen) return false;
    return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
}

$following="";
$result = $conn->query("SELECT * from users where `username` = '".$_SESSION['username']."'");
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$properties=$row["properties"];
	$propertiesStr=json_decode($properties,true);
	$following= substr(json_encode($propertiesStr["following"]),1,-1);
}

if(!(isset($_GET["user"]))){
	$sqlPost = "SELECT * FROM Phylum.posts where user in ({$following}) and `posttype`='post' ORDER BY date DESC; ";
	$sqlFile = "SELECT * FROM Phylum.posts where user in ({$following}) and `posttype`='download' ORDER BY date DESC; ";
	$sqlMedia = "SELECT * FROM Phylum.posts where user in ({$following}) and `posttype`='media' ORDER BY date DESC; ";


	

}else{
	$username=$_GET["user"];
	$sqlPost = "SELECT * FROM Phylum.posts where user = '{$username}' and `posttype`='post' ORDER BY date DESC; ";
	$sqlFile = "SELECT * FROM Phylum.posts where user = '{$username}' and `posttype`='download' ORDER BY date DESC; ";
	$sqlMedia = "SELECT * FROM Phylum.posts where user = '{$username}' and `posttype`='media' ORDER BY date DESC; ";

	if($_GET["user"]==$_SESSION['username']){
		//this is when you're on your own page
	}else{
		
		?>

		<div align="center" class="boxContainer note media" style="width:50%;min-height:20%;margin-left:25%">
			<div class="boxTitle"><?php echo $_GET["user"] ?>'s Profile</div>
			<div class="boxContent">
				<!--?php followToggle($_GET["user"]) ?-->
				<input class="boxButton" type="button" onClick="javascript:followToggle('<?php echo $_GET["user"]?>')" value="<?php echo followStatus( $_GET['user'] ) ?>">
			</div>
		</div>

		<?php
	}
}


?>

<script type="text/javascript">
	function followToggle(place){
		window.location="followToggle.php?user="+place;
	}
</script>

<!--

Media | Files | Posts
-->


<div>

	<ul class ="noteContainer media" stlye="">
		<h3 style ="margin:25px;" >Media</h3>
		<hr style ="margin:25px;">
		<?php 
		if ($result = $conn->query($sqlMedia)) {
			while ($row = $result->fetch_assoc()) {?>
			<li>
				<div align="center" class="boxContainer note media">
					<div class="boxTitle"><?php echo $row["user"] ?></div>
					<div class="boxContent">
						
						
						<div style="width:100%;" class="profileHeader" onClick="javascript:redirect('<?php echo "feed.php?user=".$row["user"] ?>')">
							<div style="float:left;width:70px"> 
								<?php echo getProfpic($row["user"]); ?>
							</div> 
							<div style="float:left;margin:0;padding:0;margin-top: -4px;"> 
								<h3><?php echo $row["user"]; ?> </h3>
								<i>posted on <?php echo date("m/d/Y", $row["date"])?> at <?php echo date("g:i A", $row["date"])?> </i>
							</div> 
							<br><br><br>
						</div>
						<hr>

						<?php
						echo $row["caption"];		
						if(endswith($row["filename"],".mp3")){?>
							<br><br>
							<audio controls="controls">  
   								<source style="position:absolute;bottom:0;" src="/media.php?id=<?php echo $row["id"]; ?>" />  
							</audio><br> 
						<?php }else if(endswith($row["filename"],".jpg")||endswith($row["filename"],".png")){?>	
							<br><br>
							<img style="max-width:30%;max-height:30%;" src="/media.php?id=<?php echo $row["id"]; ?>">
							
						<?php } ?>

								
					</div>

					<div class="boxContentBottom" onclick="javascript:download('<?php echo $row["id"] ?>')">					
						<h4  style="bottom:-50%; left: 50%;margin-left: -50px;position:absolute;">Download now!</h4>
					</div>


				</div>
			</li>
		<?php } 
			}
		?>
	</ul>

	<ul class ="noteContainer file">
		<h3 style ="margin:25px;" >Files</h3>
		<hr style ="margin:25px;">
		<?php 
		if ($result = $conn->query($sqlFile)) {
			while ($row = $result->fetch_assoc()) {?>
			<li>
				<div align="center" class="boxContainer note file">
					<div class="boxTitle"><?php echo $row["user"] ?></div>
					<div class="boxContent">
						<div style="width:100%;" class="profileHeader" onClick="javascript:redirect('<?php echo "feed.php?user=".$row["user"] ?>')">
							<div style="float:left;width:70px"> 
								<?php echo getProfpic($row["user"]); ?>
							</div> 
							<div style="float:left;margin:0;padding:0;margin-top: -4px;"> 
								<h3><?php echo $row["user"]; ?> </h3>
								<i style="font-size:12px">posted on <?php echo date("m/d/Y", $row["date"])?> at <?php echo date("g:i A", $row["date"])?> </i>
							</div> 
							<br><br><br>
						</div>
						<hr>
						<?php echo $row["caption"] ?>
					</div>
					<div class="boxContentBottom" onclick="javascript:download('<?php echo $row["id"] ?>')">					
						<h4  style="bottom:-50%; left: 50%;margin-left: -100px;position:absolute;">Download <?php echo $row["filename"] ?> now!</h4>
					</div>
				</div>
			</li>
		<?php } 
			}
		?>
		
	</ul>

	<ul class ="noteContainer post">
		<h3 style ="margin:25px;" >Posts</h3> 
		<hr style ="margin:25px;">
		<?php 
		if ($result = $conn->query($sqlPost)) {
			while ($row = $result->fetch_assoc()) {?>
			<li>
				<div align="center" class="boxContainer note post">
					<div class="boxTitle"><?php echo $row["user"] ?></div>
					<div class="boxContent">
						<div style="width:100%;" class="profileHeader" onClick="javascript:redirect('<?php echo "feed.php?user=".$row["user"] ?>')">
							<div style="float:left;width:70px"> 
								<?php echo getProfpic($row["user"]); ?>
							</div> 
							<div style="float:left;margin:0;padding:0;margin-top: -4px;"> 
								<h3><?php echo $row["user"]; ?> </h3>
								<i>posted on <?php echo date("m/d/Y", $row["date"])?> at <?php echo date("g:i A", $row["date"])?> </i>
							</div> 
							<br><br><br>
						</div><hr>
						<?php echo $row["caption"] ?>
					</div><br>

					<div class="boxContentBottom" onclick="javascript:download('<?php echo $row["id"] ?>')">					
						<h4  style="bottom:-50%; left: 50%;margin-left: -50px;position:absolute;">Download now!</h4>
					</div>

				</div>
			</li>
	
			<?php 
				}
			}
		 ?>
		
	</ul>

</div>

<iframe id="downloadframe" style="width:0;height:0"></iframe>

<script type="text/javascript">

	function download(id){
		document.getElementById('downloadframe').src = "/media.php?id="+id+"&download=yes";
	}

</script>



