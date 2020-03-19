<?php
$selected_one =  unserialize($_COOKIE["selected_one_cookie"], ["allowed_classes" => false]);
$selected_two =  unserialize($_COOKIE["selected_two_cookie"], ["allowed_classes" => false]);
$selected_three =  unserialize($_COOKIE["selected_three_cookie"], ["allowed_classes" => false]);

$classes_one =  unserialize($_COOKIE["classes_one_cookie"], ["allowed_classes" => false]);
$classes_two =  unserialize($_COOKIE["classes_two_cookie"], ["allowed_classes" => false]);
$classes_three =  unserialize($_COOKIE["classes_three_cookie"], ["allowed_classes" => false]);

?>
<!doctype html>

<html lang="en">
<head>
	
	<title>Electrical Engineering</title>
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
<!--===============================================================================================-->
</head>
	
	<body>
	
	
	<div class="limiter">
		<div class="container2-login100">
			<div class="wrap-login100">
				

				<form class="login100-form validate-form" action="main-submit.php" method="POST" style="width:50%;">
					
					<span class="login100-form-title">
						Electrical Engineering
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

								
					
								if(empty($selected_one))
								{
									$result = $classes_one;
								}
								else
								{
									$result = array_diff($classes_one, $selected_one);
								}
					
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
					
								
					
								if(empty($selected_two))
								{
									$result = $classes_two;
								}
								else
								{
									$result = array_diff($classes_two, $selected_two);
								}
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
							
								
								if(empty($selected_three))
								{
									$result = $classes_three;
								}
								else
								{
									$result = array_diff($classes_three, $selected_three);
								}
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
								/*
								$major = $_POST['studentmajor'];
								$sql = "SELECT * FROM " .$major. ";";
					

								$result = $conn->query($sql);
					

								echo '<table>';
								$count = 0;
								
								while($row = $result->fetch_assoc()){
								
								

									if($row['DIV']=='1'){
										
											
											if($count > 4){
												echo '<tr>';
												$count = 0;
											}
											
											echo '<td>';
											echo '<label class="container">';

										
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
					
					
							*/
							
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

