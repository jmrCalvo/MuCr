<?php
require_once 'php/auth_cookies.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Orpheus</title>
	<link rel="stylesheet" href="MuCr.css">
	<link rel="shortcut icon" href="img/MuCr.png">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<script src="js/MuCr.js"></script>
</head>

<body onLoad="javascript:fondoBody();">

	<nav class="sidebar">
		<div class="sidebar_principal">
			<div class="encabezado">
				<div class="imagen">
					<img src="img/MuCr.png" alt="MuCr logo">
				</div>
				<div class="titulo">Orpheus</div>
			</div>
		</div>
	</nav>

	<nav class="musica">
		<div class="principal">
			<h1>Sign in</h1>
			<FORM action="php/authentication.php" method="post">
				<input type="email" name="email" class="casilla" value="Write your email" onfocus="if (this.value=='Write your email') this.value='';"
				 onblur="if (this.value == '') this.value = 'Write your email';" required/>
				<p>Write your password:
					<input type="password" name="password1" class="casilla" required>
				</p>
				<input type="submit" class="boton" value="Enter">
			</FORM>

			<p></p>
			<h1>Sign up</h1>
			<FORM action="php/creation_user.php" method="post">
				<input type="email" name="email" class="casilla" value="Write your email" onfocus="if (this.value=='Write your email') this.value='';"
				 onblur="if (this.value=='') this.value='Write your email';" />
				<p>Write your password:
					<input type="password" name="password1" class="casilla">
				</p>
				<p>Repeat your password:
					<input type="password" name="password2" class="casilla">
				</p>
				<input type="submit" class="boton" value="Log in">
			</FORM>
		</div>
	</nav>
	<div id="info"></div>

	<script>

	</script>
</body>

</html>