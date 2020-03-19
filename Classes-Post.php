<?php

session_start();
$major =  $_SESSION['major'];
$_SESSION['selected_three_cookie'] = $_GET['selectedclasses3'];
$_SESSION['classes_three_cookie'] = $_GET['classes3'];

//setcookie("selected_three_cookie", serialize($_POST['selectedclasses3']), time()+36000);
//setcookie("classes_three_cookie", serialize($_POST['classes3']), time()+36000);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
	<?php
	
	if($major == "BIEN")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = BIEN.php"/>;';
		}
	else if($major == "CEN")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = CEN.php"/>;';	
			//<meta http-equiv="Refresh" content="0; URL = Display.php"/>;
		}
	else if($major == "CS")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = CS.php"/>;';
		}
	else if($major == "CSBA")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = CSBA.php"/>;';	
			//<meta http-equiv="Refresh" content="0; URL = Display.php"/>;
		}
	else if($major == "EE")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = EE.php"/>;';	
			//<meta http-equiv="Refresh" content="0; URL = Display.php"/>;
		}
	else if($major == "ENVE")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = ENVE.php"/>;';	
			//<meta http-equiv="Refresh" content="0; URL = Display.php"/>;
		}
	else if($major == "MSE")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = MSE.php"/>;';	
			//<meta http-equiv="Refresh" content="0; URL = Display.php"/>;
		}
	else if($major == "ME")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = ME.php"/>;';	
			//<meta http-equiv="Refresh" content="0; URL = Display.php"/>;
		}
	else if($major == "CHEN")
		{
			echo '<meta http-equiv="Refresh" content="0; URL = CHEN.php"/>;';	
			//<meta http-equiv="Refresh" content="0; URL = Display.php"/>;
		}
	?>
	
<body>
</body>
</html>