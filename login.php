 <?php
 	if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
 		header("Location: loginValidate.php?username=".$_COOKIE["username"]."&password=".$_COOKIE["password"]);
 		die();
 	}
 ?>

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
				<form action="loginValidate.php">
					<div class="boxTitle">Login</div>
					<input class="boxText" type="text" placeholder="username" name="username" style="width:60%"><br>
					<input class="boxText" type="password" placeholder="password" name="password" style="width:60%"><br>
					 <input type="submit" value="login" class="boxButton">

					<input type="button" value="register" onclick="location.href='/register.php';" class="boxButton">

				</form>
			</div>
		</div>
	</body>
</html>

