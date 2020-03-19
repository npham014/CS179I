<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Create Account Post</title>
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
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['pass'];
	
	$sql = "INSERT INTO ACCOUNTS (FNAME, LNAME, EMAIL, PASSWORD) VALUES ('$fname', '$lname', '$email', '$password');";
	
	$result = $conn->query($sql);
	$dummyvariable = 0;
	?>
	<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;
<body>
</body>
</html>