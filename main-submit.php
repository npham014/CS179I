<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Compare</title>
</head>
	<?php
    

	$selectedclasses = $_POST['selectedclasses'];
	
	$AllClasses = $_POST['classes'];
	
	$result = array_diff($AllClasses, $selectedclasses);
	//print_r($result);
	
	if(empty($result))
	{
		echo 'You Graduted!! <br>';
	}
	else{
		echo 'Sorry Buddy, you are not graduating :( <br>';
		foreach($result as &$value){
			echo $value;
			echo '<br>';
		}
	}
	
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
	
	
	
	
	
	
	mysqli_close($conn);
	?>
<body>
</body>
</html>