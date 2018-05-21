<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>MuCr - Concerts</title>
	<link rel="stylesheet" href="MuCr.css">
	<link rel="shortcut icon" href="img/MuCr.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/MuCr.js"></script>
</head>

<body class="stage3">
	<nav class="sidebar">
		<div class="user">
			<div class="imagen">
				<img src="img/amy.jpg" alt="Profile picture">
			</div>
			<div class="titulo">
				<?php
					include 'php/write_username.php'
				?>
			</div>
		</div>
		<a class="blanco" href="MuCr_settings.php">
			<div class="options">
				<img src="img/icons/settings.png" alt="Settings">Ajustes
			</div>
		</a>
	</nav>

	<div class="dora">
		<input type="text" class="dorado" value="search" onfocus="if (this.value=='search') this.value='';" onblur="if (this.value=='') this.value='search';"
		/>
	</div>

	<nav class="musica">
		<a href="MuCr_main.php	">
			<div class="boton_derecha">
				<img src="img/icons/music.jpg" alt="Music icon">Music
			</div>
		</a>
		<a href="MuCr_concert_artist.php">
			<div class="boton_izquierda">
				<img src="img/icons/concierto.png" alt="Concert icon">Concerts
			</div>
		</a>
		<div class="collection">

			<div class="dropdown">
				<button onclick="myFunction()" class="dropbtn">Sorted by</button>
			</div>

			<div class="orden">
				<div class="especialized_back">New Seacrh</div>
				<div class="especialized">Alternative</div>
				<div class="especialized">Punk</div>
				<a class="blanco" href="MuCr_collection.php">
					<div class="especialized">Rock</div>
				</a>
				<div class="especialized"> Blues</div>
				<div class="especialized"> Classical</div>
				<div class="especialized"> Country</div>
				<div class="especialized">Folk</div>
				<div class="especialized">Dance</div>
				<div class="especialized"> Electronic</div>
				<div class="especialized"> Easy Listening</div>
				<div class="especialized"> Gospel</div>
				<div class="especialized"> Religious</div>
				<div class="especialized"> Rap</div>
				<div class="especialized"> Holiday</div>
				<div class="especialized"> Instrumental</div>
				<div class="especialized"> Jazz</div>
				<div class="especialized"> Latin</div>
				<div class="especialized"> Metal</div>
				<div class="especialized"> Moods</div>
				<div class="especialized"> Pop</div>
				<div class="especialized"> Other</div>
				<div class="especialized"> R'n'B</div>
				<div class="especialized"> Soundtrack</div>
				<div class="especialized"> World</div>
			</div>
	</nav>

	<a href="../php/delete_cookies.php">
		<nav class="exit_sidebar">
			<img src="img/icons/close.png" alt="close">
		</nav>
	</a>

	<div class="concert_title">
		Concerts
	</div>

	<div class="milibreria_concerts">
		<button class="but_my_concerts" onclick="window.location.href='MuCr_concert_artist.php'">
			<img src="img/icons/tickets_icon.png" alt="ticket_icon"> &nbsp;My concerts
		</button>
		<button class="but_recom" onclick="window.location.href='MuCr_concert_recom.php'">
			<img src="img/icons/recommendation_icon.png" alt="recommendation_icon"> &nbsp;Recommendations
		</button>
		<button class="but_near_in">
			<img src="img/icons/pushpin_icon.png" alt="pushpin_icon"> &nbsp;Near
		</button>
	</div>

	<div class="near_scroll">
		<div class="concert">
			<img src="img/concerts/posters/bowie.jpg" alt="David Bowie">
			<div class="name_artist">
				David Bowie
			</div>
			<div class="location_date">
				10 April 2018
				<br/> Cheapest: 80€
			</div>
			<div class="city_near">
				<img src="img/ciudades/iasi.jpg" alt="ciudad">
				<div class="flag">
					<img src="img/flags/rom.png" alt="bandera">
				</div>
				<div class="titulo">IASI</div>
			</div>
		</div>
		<div class="concert">
			<img src="img/concerts/posters/McCartney.jpg" alt="Paul McCartney">
			<div class="name_artist">
				Paul McCartney
			</div>
			<div class="location_date">
				29 May 2018
				<br/> Cheapest: 80€
			</div>
			<div class="city_near">
				<img src="img/ciudades/budapest.jpg" alt="ciudad">
				<div class="flag">
					<img src="img/flags/hun.jpg" alt="bandera">
				</div>
				<div class="titulo">BUDAPEST</div>
			</div>
		</div>
		<div class="concert">
			<img src="img/concerts/posters/foo_fighters.jpg" alt="Foo Fighters">
			<div class="name_artist">
				Foo Fighters
			</div>
			<div class="location_date">
				16 June 2018
				<br/> Cheapest: 80€
			</div>
			<div class="city_near">
				<img src="img/ciudades/Bucuresti.jpg" alt="ciudad">
				<div class="flag">
					<img src="img/flags/rom.png" alt="bandera">
				</div>
				<div class="titulo">BUCHAREST</div>
			</div>
		</div>
		<div class="concert">
			<img src="img/concerts/posters/rolling_stones.jpg" alt="The Rolling Stones">
			<div class="name_artist">
				The Rolling Stones
			</div>
			<div class="location_date">
				18 June 2018
				<br/> Cheapest: 80€
			</div>
			<div class="city_near">
				<img src="img/ciudades/cluj.jpg" alt="ciudad">
				<div class="flag">
					<img src="img/flags/rom.png" alt="bandera">
				</div>
				<div class="titulo">CLUJ</div>
			</div>
		</div>
		<div class="concert">
			<img src="img/concerts/posters/general.jpg" alt="Basic">
			<div class="name_artist">
				Paco paquez
			</div>
			<div class="location_date">
				5 August 2018
				<br/> Cheapest: 2€
			</div>
			<div class="city_near">
				<img src="img/ciudades/chisinau.jpg" alt="ciudad">
				<div class="flag">
					<img src="img/flags/mol.png" alt="bandera">
				</div>
				<div class="titulo">CHISINAU</div>
			</div>
		</div>
	</div>

</body>

</html>