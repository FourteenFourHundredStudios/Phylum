<title>Search</title>

<?php 

	include 'header.php';

	$SearchQuery=$_GET["SearchQuery"];
	$sql = "SELECT * FROM Phylum.users where `username` like '%{$SearchQuery}%';"
?>

<ul class ="noteContainer media" stlye="">
	<h3 style ="" >Users</h3>
	<hr>
	<?php
	if ($result = $conn->query($sql)) {
			while ($row = $result->fetch_assoc()) {?>

			<div style="">
				<li >
					<div style="width:100%;color:black;" class="profileHeader" onClick="javascript:redirect('<?php echo "feed.php?user=".$row["username"] ?>')">
						<div style="float:left;width:70px"> 
							<?php echo getProfpic($row["username"]); ?>
						</div> 
						<div style="float:left;margin:0;padding:0;margin-top: -4px;"> 
							<h3><?php echo $row["username"]; ?> </h3>
							<i>Phylum user</i>
						</div> 
						<br><br>
					</div>
					<hr>
				</li>
			<div>

	<?php 
			}
		}
	?>

</ul>
