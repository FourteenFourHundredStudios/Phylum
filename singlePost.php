<?php 
	include 'header.php';
?>


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
		</div>
		<hr>
		<?php echo $row["caption"] 
		if(endswith($row["filename"],".mp3")){?>
				<br><br>
				<audio controls="controls">  
   					<source style="position:absolute;bottom:0;" src="/media.php?id=<?php echo $row["id"]; ?>" />  
				</audio><br> 
		<?php }else if(endswith($row["filename"],".jpg")||endswith($row["filename"],".png")){?>	
				<br><br>
				<img style="max-width:30%;max-height:30%;" src="/media.php?id=<?php echo $row["id"]; ?>">
							
		<?php } ?>



	</div><br>

	<div class="boxContentBottom" onclick="javascript:download('<?php echo $row["id"] ?>')">					
		<h4 style="bottom:-50%; left: 50%;margin-left: -50px;position:absolute;">Download now!</h4>
	</div>

</div>