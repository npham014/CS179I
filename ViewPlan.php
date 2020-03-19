<?php
session_start();

$email = $_SESSION['user'];

if($_SESSION['user'] == '0')
{

	echo '<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;';
}


?>
<!doctype html>

<html lang="en">
<head>
	
	<title>Course Plan</title>
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
							  <li class="menu-watch" >
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
		<div class="container2-login100" >
			<div class="wrap-login100">
				

				
				
					<span class="login100-form-title">
						Created Course Plan
					</span>
					
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

				
					$plan = array();
					$plandisplay = array();
					$sql = "SELECT * FROM ACCOUNTS WHERE EMAIL='".$email."';";
					$return =  $conn->query($sql);
					while($row = $return->fetch_assoc())
					{
						$test = $row['COURSEPLAN'];
					}
					
					$myJSON = json_decode($test);
					
					$fall19 = $myJSON->F19;
					$fall20 = $myJSON->F20;
					$fall21 = $myJSON->F21;
					$fall22 = $myJSON->F22;
					
					$winter20 = $myJSON->W20;
					$winter21 = $myJSON->W21;
					$winter22 = $myJSON->W22;
					$winter23 = $myJSON->W23;
					
					$spring20 = $myJSON->S20;
					$spring21 = $myJSON->S21;
					$spring22 = $myJSON->S22;
					$spring23 = $myJSON->S23;
				
				
				
					//fall
				
			
					
				
			echo '<div class="container" style="text-align: center;">';

					echo ' <div class="row">';
					echo '<div class="col-sm-4">';
					echo '<h4>Fall 19</h4>';
					echo '<p>';
					foreach($fall19 as &$currClass)
					{
						//echo 'fall 19: '.$currClass .'  <br>';
						echo $currClass .'<br>';
	
						 
					}
				echo '</p>';
				echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Winter 20</h4>';
				echo '<p>';
					foreach($winter20 as &$currClass)
					{
						//echo 'winter 20: '.$currClass .'  <br>';
						echo $currClass .'<br>';
	
					}
				echo '</p>';
				echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Spring 20</h4>';
				echo '<p>';
					foreach($spring20 as &$currClass)
					{
						//echo 'spring 20: '.$currClass .'  <br>';
						echo $currClass .'<br>';
				
					}
				echo '</p>';
				echo '</div>';
				
				echo '</div>';
				echo '<br>';
				echo ' <div class="row">';
					echo '<div class="col-sm-4">';
				echo '<h4>Fall 20</h4>';
				echo '<p>';
					foreach($fall20 as &$currClass)
					{
						//echo 'fall 20: '.$currClass .' <br>';
						echo $currClass .'<br>';
				
					}
				echo '</p>';
				echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Winter 21</h4>';
				echo '<p>';
					foreach($winter21 as &$currClass)
					{
						//echo 'winter 21: '.$currClass .' <br>';
						echo $currClass .'<br>';
					
					}
				echo '</p>';
			echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Spring 21</h4>';
				echo '<p>';
					foreach($spring21 as &$currClass)
					{
						//echo 'spring 21: '.$currClass .' <br>';
						echo $currClass .'<br>';
					
					}
				echo '</p>';
					echo '</div>';
				
				echo '</div>';
				echo '<br>';
				echo ' <div class="row">';
					echo '<div class="col-sm-4">';
				echo '<h4>Fall 21</h4>';
				echo '<p>';
					foreach($fall21 as &$currClass)
					{
						//echo 'fall 21: '.$currClass .' <br>';
						echo $currClass .'<br>';
					
					}
				echo '</p>';
				echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Winter 22</h4>';
				echo '<p>';
					foreach($winter22 as &$currClass)
					{
						//echo 'winter 22: '.$currClass .' <br>';
						echo $currClass .'<br>';
					
					}
				echo '</p>';
			echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Spring 22</h4>';
				echo '<p>';
					foreach($spring22 as &$currClass)
					{
						//echo 'spring 22: '.$currClass .' <br>';
						echo $currClass .'<br>';
				
					}
				echo '</p>';
			echo '</div>';
				
				echo '</div>';
				echo '<br>';
				echo ' <div class="row">';
					echo '<div class="col-sm-4">';
				echo '<h4>Fall 22</h4>';
				echo '<p>';
					foreach($fall22 as &$currClass)
					{
						//echo 'fall 22: '.$currClass .' <br>';
						echo $currClass .'<br>';
					
					}
				echo '</p>';
					echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Winter 23</h4>';
				echo '<p>';
					foreach($winter23 as &$currClass)
					{
						//echo 'winter 23: '.$currClass .' <br>';
						echo $currClass .'<br>';
				
					}
				echo '</p>';
				echo '</div>';
				echo '<div class="col-sm-4">';
				echo '<h4>Spring 23</h4>';
				echo '<p>';
					foreach($spring23 as &$currClass)
					{
						//echo 'spring 23: '.$currClass .' <br>';
						echo $currClass .'<br>';
					
					}
				echo '</p>';
					echo '</div>';
				
				echo '</div>';
					echo '</div>';
					
					
				//echo '</div>';			
			
					
					//echo json_decode($plan);
					//print_r($plandisplay);
					
							mysqli_close($conn);
							?>
					
            <form class="login100-form validate-form" action="Download.php" method="POST" align="center"  style="width:100%;">
        		
          <div class="container2-login100-form-btn" align="center" >
            <input name="submit" style="width:50%;" type="submit" class="login100-form-btn"  value="Download" />
        
			  </div>
					
					
			
    </form>
	
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

</body>
<footer style="float: left;"><!-- Copyright -->
  <div align="left" style="float: left;"><img src="img/test.png" alt="IMG" style="width:300px;height:300px;"></div>
	</footer>
	<footer style="float: right;">
  <div style="float: right; bottom: 0;"  align="right">© 2020 Copyright: UCRPlanner.club</div>
   
  
  <!-- Copyright --> </footer>	
</html>
