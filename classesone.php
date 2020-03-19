<?php

session_start();
$_SESSION['major'] = $_GET['studentmajor'];
if($_SESSION['user'] == '0')
{

	echo '<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;';
}
else{
	//echo 'Logged in as: ' . $_SESSION['user'] . '<br>';
}


?>
<!doctype html>
<html lang="en">
<head>
	
	<title>Select Classes</title>
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
							  <li class="menu-watch " >
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
			<div class="wrap-login100" style="/*min-width: max-content; */">
				
				<form class="login100-form validate-form" action="classestwo.php" method="GET" style="width: 100%;">
					
					<span class="login100-form-title" style="/*width:500px; text-align: left;*/">
						Select Lower Division Courses Taken
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


								
								$major = $_SESSION['major'];
								//Just for testing purposes
							
								$sql = "SELECT * FROM " .$major. ";";
								
								//end testing

								$result = $conn->query($sql);
					

								echo '<table class="table table-responsive">';
								$count = 0;
								
								while($row = $result->fetch_assoc()){
								
								

									if($row['DIV']=='0'){
										
											
											if($count > 4){
												echo '<tr>';
												$count = 0;
											}
											
											echo '<td>';
											echo '<label class="container2">';

										
											echo $row['REQUIREMENTS'];
									
											echo '<input type="hidden" name="classes[]" id="classes[]" value="'.$row['REQUIREMENTS'].'">';
											echo '<input type="checkbox" name="selectedclasses[]" id="selectedclasses[]" value="'.$row['REQUIREMENTS'].'">';
										
											echo '<span class = "checkmark"></span>';
										
											echo '</label>';
											echo '</td>';
											$count++;
											
									}
								
									
									
								}
								
								echo '</table>';
					
					

							mysqli_close($conn);
							?>
            
        
          <div class="container2-login100-form-btn"><span class="login100-form-btn">
            <input name="submit" type="submit" class="login100-form-btn"  value="Submit" />
          </span>
			  
			  </div>
					<div class="text-center p-t-136">					
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
	<script src="vendor/bootstrap/js/bootstrap.js"></script>
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


