<?php 
include "cleanheader.php";
$comment = "comment".rand();
?>
<div class='boxContainer note comment'>
	<div style='float:left;width:10%;height:40px;'>
		<?=getProfpic($_SESSION['username'])?>
	</div>
	<input type='text' style='width:80%;float:left; margin-top:2px;' id="<?php echo $comment ?>" onkeypress="return sendComment(event)" placeholder='write a comment!' class='boxText'><br>
</div>

<div class='boxContainer note comment' style="min-height:30%;max-height:30%;overflow:hidden;overflow-y:auto;padding:0px">
	<div style="padding:10px;margin;10px;border:10px">
		<ul style="list-style:none;list-style-type:none;margin:5px;padding:0px;">


			<?php for($i=0;$i<10;$i++){ ?>
			<li style="list-style:none;list-style-type:none;margin:0px;padding:0px;">
				<div style="width:95%;" class="profileHeader" onClick="javascript:redirect('<?php echo "feed.php?user=".$row["user"] ?>')">	
				<div style="float:left;width:70px"> 
					<!-- put real prof pic here -->
					<?php echo getProfpic("phylum"); ?>
				</div> 

				<div style="float:left;"> 
					<b><?php echo "username goes here"?></b><br>
					comment
				</div><br><br>
				<hr style="clear:both">
			</li>
			<?php } ?>


		</ul>
	</div>

</div>
