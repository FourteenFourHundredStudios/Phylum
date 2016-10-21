
<?php
session_start();
if(!(isset($_SESSION['username']))){
	header('Location: index.php?error=You need to login to view this page') ;	
	die();	
} 
echo '<link rel="stylesheet" type="text/css" href="style.css">';

include('database.php'); 
include('userfunctions.php'); 

?>


<div style="">
	<ul class ="navBar" id="navBar">
		<li><input type="button" style="float:left;" class="boxButtonDark" onclick="window.location='/feed.php';" value="Feed"></li>
		<li><input type="button"  onclick="window.location='/logout.php';" style="float:right;" class="boxButtonDark" value="Logout"></li>
		<li><input type="button" style="float:right;" onclick="javascript:redirect('feed.php?user=<?php echo $_SESSION['username'] ?>')" class="boxButtonDark" value="<?php echo $_SESSION['username'] ?>"></li>
		<li><input type="button" style="float:right;" class="boxButtonDark" value="Post"  onclick="javascript:expandNavBar()"></li>
		
		<form action="quicksearch.php">
			<li><input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" type="text"  tabindex="-1" id="searchbox" style="float:left;max-width:50%" class="boxText" name="SearchQuery" placeholder="Search Phylum!"></li>
		</form>

		<br>



		<form action="post.php" method="post" enctype="multipart/form-data">
			<!--div class="boxTitle" style="margin-left:auto">Create a post!</div><br-->
			<input type="submit" value="post" class="boxButtonDark">
			<input class="boxText" type="text" placeholder="comment" name="caption" style="width:60%">
			
			<input type="file" align="center" name="userFile" id="userFile" value="select file" onclick="" >
		</form>

	</ul>
</div>

<br><br><br><br>



<center>
	<div id="postBoxWindow"></div>
</center>

<iframe frameborder="0" scrolling="no" style="width:0;height:0;opacity:100%;border:0px;" id="backgroundContent"></iframe>



<script type="text/javascript">
	//bar.style.height="60px";


	function expandNavBar(){
	//	alert("navBar expanding");

		bar = document.getElementById("navBar");
		if(bar.style.height==="60px"){
			bar.style.height =  '120px';
		}else{
			bar.style.height =  '60px';
		}
	}

/*
	function postBox(){
		document.getElementById("postBoxWindow").innerHTML='<?php 

		
		$myfile = fopen("postbox.php", "r");
		
		
		$fil= fread($myfile,filesize("postbox.php"));
		$fil = str_replace("\n","",$fil);
		echo $fil;
		fclose($myfile);
		

		?>';
	}
*/
	function redirect(loc){
		window.location=loc;
	}

/*
	function searchTyped(){
		redirect("quicksearch.php?SearchQuery="+document.getElementById('searchbox').value);
	}
*/
</script>

