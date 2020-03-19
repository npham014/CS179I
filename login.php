<?php

session_start();

if($_SESSION['user'] == '0')
{

	echo '<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;';
}
else{
	//echo 'Logged in as: ' . $_SESSION['user'] . '<br>';
}
$userr = $_SESSION['user'];
?>

<!doctype html>
<html>
<head>
	<title>UCR Planner</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="util.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="menu.css">
<!--===============================================================================================-->



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

	
	

?>	
	
</head>
<body>
	<div class="limiter">
		<!----------------Menu adding to top of page code below -->
				<header>
						<nav>
						  <div class="menu-container">
							<!-- Menu -->
							<ul class="menu">
							  <li class="menu-apple">
								<a href="login.php">
									<span class="focus-input100"></span>
								  <i class="fa fa-home apple-icon" aria-hidden="true"></i>
								</a>
							  </li>
							  <li class="menu-mac">
								<a href="ViewPlan.php">
									<span class="focus-input100"></span>
								  <span>View Course Plans</span>
								</a>
							   </li>
							  <li class="menu-watch" style="/*margin-left: 525px;*/">
								<a href="Account.php">
									<span class="focus-input100"></span>
								  <i class="fa fa-user-circle apple-icon " aria-hidden="true"></i>
								</a>
							  </li>
							  <li class="menu-store"  >
								<a href="logout-post.php">
									<span class="focus-input100"></span>
									
								  <i class="fa fa-sign-out apple-icon" aria-hidden="true"></i>
								</a>
							  </li>
							</ul>

							

						  </div>
						</nav>
			</header>
			<div class="fade-screen"></div>
		<!----------------end of menu code -->
		<div class="container2-login100">
			
			
			<div class="wrap-login100">
				
				<div class="login100-pic js-tilt" data-tilt style="margin-top: 80px;">
					<img src="img/logo.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="classesone.php" method="GET">
					<span class="login100-form-title">
						Select Major
					</span>
    				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						
					
            <?php
			  	$sql = "SELECT * FROM BCOE;";
	
				$result = $conn->query($sql);
	
				
				echo '<select name="studentmajor" class="input100">';
				
				while($row = $result->fetch_assoc()){
					$major = $row['MAJORS'];
		
					$display = $row['DISPLAY'];
		
					echo '<option value=' . $major . '>' . $major. ' - ' .$display . '</option>';
		
		
				}
				echo '</select>';
				
			  ?>
        
          <div class="container2-login100-form-btn"><span class="login100-form-btn">
            <input name="submit" type="submit" class="login100-form-btn"  value="Submit" />
          </span>
			  </div>
						
				
					
		<div class="text-center p-t-136">
						
					</div>
   
	<?php
		mysqli_close($conn);
	?>
		</div>
					
		</div>
				
				
					
		</div>
			</div>
	<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="main.js"></script>
<?php
		$dummy = '0';
		
		?>
</body>
<footer style="float: left;"><!-- Copyright -->
  <div align="left" style="float: left;"><img src="img/test.png" alt="IMG" style="width:300px;height:300px;"></div>
	</footer>
	<footer style="float: right;">
  <div style="float: right; bottom: 0;"  align="right">© 2020 Copyright: UCRPlanner.club</div>
   
  
  <!-- Copyright --> </footer>	
</html>
