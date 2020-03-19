<?php

session_start();
$_SESSION['user'] = $_POST['email'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Verify</title>
</head>
<?php
	$servername = "jsanc10342451.domaincommysql.com";
	$username = "jsanc103";
	$password = "11Assassin13!";
	$dbname = "ucr_db1";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$email = $_POST['email'];
	$passwor = $_POST['pass'];
	
	 	
	
	$sql = "SELECT * FROM ACCOUNTS WHERE EMAIL='". $email ."' AND  PASSWORD='". $passwor  ."';";
	
	if($result = $conn->query($sql))
	{
		if($row = $result->fetch_assoc())
		{
			echo '<meta http-equiv="Refresh" content="0; URL = login.php"/>;';
		}
		else
		{
			echo '<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;';	
		}
	}
		
	mysqli_close($conn);
	?>
<body>
</body>
</html>