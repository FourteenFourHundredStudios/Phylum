
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
				<?= getPost($row["id"])?>  
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
				<?= getPost($row["id"])?>  

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
				<?= getPost($row["id"])?>  
			</li>
	
			<?php 
				}
			}
		 ?>
		
	</ul>

</div>


<div id="window"></div>

<iframe id="downloadframe" style="width:0;height:0;border:0px;"></iframe>



<script type="text/javascript">
	
	function download(id){
		document.getElementById('downloadframe').src = "/media.php?id="+id+"&download=yes";
	}

	function rate(id){

		//document.getElementById("window").innerHTML+="<div class='boxContainer note popup' >Rating dialog goes here</div>";
		

		message = document.createElement("div");
		message.className='boxContainer note popup';
		message.align="center";
		message.id=Math.random();

		//message.style.border="thin solid yellow";

		document.getElementById('window').appendChild(message);

		messageHeader = document.createElement("div");
		messageHeader.className='boxTitle';
		messageHeader.innerHTML="Rate this post!";


		message.appendChild(messageHeader);


		content="";
		content+="<br>How many stars does this post deserve?<br><br>";

		content+="<div id='ratings'>";
		for(var i=1;i<6;i++){
			content+="<img onClick='setRate("+message.id+","+(i)+")' src='/images/star_empty.png' width='40' height='30'>";	
		}
		content+="</div>";
		
		content+='<br><input type="button" onClick="closeRate('+message.id+')" class="boxButtonDark" style="width:30%" value="Cancel">';
		content+='<input type="button" onClick="saveRate('+id+')" class="boxButtonDark" style="width:30%" value="Rate!">';

		message.innerHTML+=content;
	}


	function closeRate(id){
		var element = document.getElementById(id);
		//var element = message;
		element.outerHTML = "";
		delete element;
	}

	function saveRate(id){
		window.location="rate.php?post="+id+"&stars="+message.stars;
	}


	function sendComment(e) {
		
	    if (e.keyCode == 13) {
	     //   var tb = document.getElementById("scriptBox");
	       alert("dd");
	        return false;
	    }
	}

	function comment(id){
		//<div class='boxContainer'></div>

		 var xhReq = new XMLHttpRequest();
		 xhReq.open("GET", "comment.php?id="+id, false);
		 xhReq.send(null);
		 var serverResponse = xhReq.responseText;
		 //alert(serverResponse);

		//input=serverResponse;
	//	if(serverResponse!=null){
			document.getElementById(id).innerHTML=serverResponse;
	//	}
	}

	function setRate(id, rate, postid){
		//alert(id+","+rate);
	//	alert(rate);
		for (var i=0;i<document.getElementById(id).childNodes.length;i++){
			if(document.getElementById(id).childNodes[i].id == "ratings" ){

				//alert(rate);
				message.stars=rate;

				starDisplay="";

				for(var j=1;j<rate+1;j++){
				starDisplay+= "<img onClick='setRate("+message.id+","+(j)+")' src='/images/star_full.png' width='40' height='30'>";
					stars=j;
				}

				for(var j=stars+1;j<6;j++){
					starDisplay+= "<img onClick='setRate("+message.id+","+(j)+")' src='/images/star_empty.png' width='40' height='30'>";
				}
				starDisplay+="";

				//console.log(starDisplay);
				document.getElementById(id).childNodes[i].innerHTML=starDisplay;
				//return;
			}
		}

		
	}

</script>



