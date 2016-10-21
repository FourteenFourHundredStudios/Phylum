
<?php
//NO SINGLE QUOTES IN THIS PAGE BECAUSE IT IS PARSED DIRECTLY INTO  JAVASCRIPT 
//ALSO NO HTML COMMENTS BECAUSE OF WHAT WAS STATED ABOVE
?>


<link rel="stylesheet" type="text/css" href="style.css">

<style>
.fileinput input {
  display: inline;
  float: center;


}

.fileinput{
	

}
</style>

<body style="background:none transparent;">
	<div align="center" class="boxContainer"  >
	<form action="post.php" method="post" enctype="multipart/form-data">
		<div class="boxTitle">Post</div>
			<input class="boxText" type="text" placeholder="comment" name="caption" style="width:60%">
			<input type="submit" value="post" class="boxButton">


				<input type="file" align="center" name="userFile" id="userFile" value="select file" onclick="" >
		

		</form>
	</div>
</body>

