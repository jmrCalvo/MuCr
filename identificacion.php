<?php
$email=$_POST['email'];
$password1=$_POST['password'];

$servername = "db4free.net";
$username = "jmrodriguez";
$password = "9uk6vw6e";
$dbname = "orfeo_mucr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	 while($row = mysqli_fetch_assoc($result)) {
		if($row["email"]==$email){
			if($row["password"]==$password1){
				header('Location: MuCr_main.html');}
			else{header('Location: index.html');}
		}
		else{header('Location: index.html');}
	}
}
$conn->close();
