<?php
session_start();

$email = $_SESSION['user'];
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
	
	$sql = "SELECT * FROM ACCOUNTS WHERE EMAIL='".$email."';";
	$return =  $conn->query($sql);
	while($row = $return->fetch_assoc())
	{
		$generate_json = $row['COURSEPLAN'];
	}




	$myJSON = json_decode($generate_json);
	//$file = "test.txt";
	$file = "courseplan.csv";

	$myJSON2 = $myJSON;

	array_push($myJSON2->F19, 'FALL 19');
	array_push($myJSON2->F20, 'FALL 20');
	array_push($myJSON2->F21, 'FALL 21');
	array_push($myJSON2->F22, 'FALL 22');


	array_push($myJSON2->W20, 'WINTER 20');
	array_push($myJSON2->W21, 'WINTER 21');
	array_push($myJSON2->W22, 'WINTER 22');
	array_push($myJSON2->W23, 'WINTER 23');


	array_push($myJSON2->S20, 'SPRING 20');
	array_push($myJSON2->S21, 'SPRING 21');
	array_push($myJSON2->S22, 'SPRING 22');
	array_push($myJSON2->S23, 'SPRING 23');




$txt = fopen($file, "w") or die("Unable to open file!");
//file_put_contents($txt, print_r($myJSON, TRUE));
//fwrite($txt, var_export($myJSON->F19, true));
//fwrite($txt, date( 'm-d-Y ' ). PHP_EOL );
foreach($myJSON2 as $JSON){
	fputcsv($txt, $JSON);
}
//fwrite($txt, print_r($myJSON, TRUE));
fclose($txt);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);
exit;

echo '<meta http-equiv="Refresh" content="0; URL = ViewPlan.php"/>;';
?>

