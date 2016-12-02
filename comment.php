<?php 
include "cleanheader.php";

$id=$_GET['id'];
//$comment = "comment".$id;

$sql="SELECT * FROM Phylum.comments where `postid`='{$id}' ORDER BY date DESC;" ;

?>
<div class='boxContainer note comment'>
	<div style='float:left;width:10%;height:40px;'>
		<?=getProfpic($_SESSION['username'])?>
	</div>
	<input type='text' style='width:80%;float:left; margin-top:2px;' id="combox<?php echo $id ?>" onkeypress="return sendComment(event,this.id,'<?=$id?>')" placeholder='write a comment!' class='boxText'><br>
</div>

<div class='boxContainer note comment' style="min-height:30%;max-height:30%;overflow:hidden;overflow-y:auto;padding:0px">
	<div style="padding:10px;margin;10px;border:10px">
		<ul style="list-style:none;list-style-type:none;margin:5px;padding:0px;">


			<?php $t="no";
			if ($result = $conn->query($sql)) {
				while ($row = $result->fetch_assoc()) {
					$t="yes"
					?>
			 
			<li style="list-style:none;list-style-type:none;margin:0px;padding:0px;">
				<div style="width:95%;" class="profileHeader" onClick="javascript:redirect('<?php echo "feed.php?user=".$row["username"] ?>')">	
				<div style="float:left;width:70px"> 
					<!-- put real prof pic here -->
					<?php echo getProfpic($row["username"]); ?>
				</div> 

				<div style="float:left;"> 
					<b><?php echo $row['username']?></b><br>
					<?= $row['comment']?>
				</div><br><br>
				<hr style="clear:both">
			</li>
			<?php }
			} if($t=="no"){
				echo "<center>no comments to show!</center>";
			}
			 ?>


		</ul>
	</div>

</div>
