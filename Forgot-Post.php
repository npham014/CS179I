<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Post</title>
	
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
	
	$sql = "SELECT * FROM ACCOUNTS WHERE FNAME='".$fname."' AND LNAME='".$lname."' AND EMAIL='". $email ."' ;";
	
	if($result = $conn->query($sql))
	{
		if($row = $result->fetch_assoc())
		{
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$send = '<html><head><a href="#"><img src="https://i.imgur.com/zivxHE1.gif" alt="source" width=250/></a> </head><body> <font size="4">';
			$send .= 'This email is for '.$fname.' '.$lname.' regarding a forgotten password. Do not worry, Ucrplanner.club is here to help. The password for your account is: <br><font color="red">';
			$send .=$row['PASSWORD'];
			$send .='</font></font></body></html>';
			//$message = wordwrap($send, 90, "\r\n");

			// Send
			
			mail($email, 'Forgot Password', $send, $headers);
			
			echo '<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;';
			
		}
		else
		{
			echo '<meta http-equiv="Refresh" content="0; URL = Forgot.php"/>;';	
		}
	}
	
	?>
	
<body>
</body>
</html>