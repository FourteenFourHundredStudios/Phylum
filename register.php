<html>
	<head>
		<title>Phylum! Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<!-- top color: rgb(38, 77, 115) -->
	<body>
		<div align="center" >
			<?php if(isset($_GET['error'])){ ?>
				<div class="boxMessage"> <?php echo $_GET["error"] ?> </div>
			<?php } ?>
			<div align="center" class="boxContainer">
				<form action="registerValidate.php">
					<div class="boxTitle">Register</div>
					<input class="boxText" type="text" placeholder="username" name="username" style="width:60%"><br>
					<input class="boxText" type="password" placeholder="password" name="password" style="width:60%"><br>
					<input class="boxText" type="password" placeholder="repeat password" name="passwordRepeat" style="width:60%"><br>
					<input class="boxText" type="text" placeholder="email" name="email" style="width:60%"><br>
					<input type="submit" value="register" class="boxButton">
			
				</form>
			</div>
		</div>
	</body>
</html>