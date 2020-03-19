<?php
session_start();

$selected_one = $_SESSION['selected_one_cookie'];
$selected_two = $_SESSION['selected_two_cookie'];
$selected_three = $_SESSION['selected_three_cookie'];

$classes_one = $_SESSION['classes_one_cookie'];
$classes_two = $_SESSION['classes_two_cookie'];
$classes_three = $_SESSION['classes_three_cookie'];
//$selected_one =  unserialize($_COOKIE["selected_one_cookie"], ["allowed_classes" => false]);
//$selected_two =  unserialize($_COOKIE["selected_two_cookie"], ["allowed_classes" => false]);
//$selected_three =  unserialize($_COOKIE["selected_three_cookie"], ["allowed_classes" => false]);

//$classes_one =  unserialize($_COOKIE["classes_one_cookie"], ["allowed_classes" => false]);
//$classes_two =  unserialize($_COOKIE["classes_two_cookie"], ["allowed_classes" => false]);
//$classes_three =  unserialize($_COOKIE["classes_three_cookie"], ["allowed_classes" => false]);

?>
<!doctype html>

<html lang="en">
<head>
	
	<title>Computer Science</title>
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
						Computer Engineering
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

					
								//empty array
								$result1 = [];
					//if no classes were selected for on page classesone.php
								if(empty($selected_one))
								{
									//then assigned the needed classes as all classes on that page
									$result1 = $classes_one;
								}
								else
								{
									//else assign the classes that were not selected to the result1 array
									$result1 = array_diff($classes_one, $selected_one);
								}
		
					
								//same as result1 but with classestwo.php
								$result2 = [];
								if(empty($selected_two))
								{
									$result2 = $classes_two;
								}
								else
								{
									$result2 = array_diff($classes_two, $selected_two);
								}
								
								//same as result1 but with classesthree.php
								$result3 = [];
								if(empty($selected_three))
								{
									$result3 = $classes_three;
								}
								else
								{
									$result3 = array_diff($classes_three, $selected_three);
								}
	
						//first assign lower division classes if needed
					
					$sql = "SELECT * FROM CHEN;";
					
					//for classes one
					$schedule = $conn->query($sql);
				
					$classArr = array();	//array of classes that the studenent needs to take NOTE: this is just all the classes that the student did not select
					$avaArr = array();		//array of those classed FWS, EX $classArr[1] = CS010, $avaArr['CS010'] = FW
					$preArr = array();		//the prerequisite for the class EX $classArr[1] = CS010, $preArr['CS010'] = '0' no prereq, $preArr['CS012'] = 'CS010'
 					$testcount = 0;
					
					//loop through all courses in the database for CS
					while($row = $schedule->fetch_assoc())
					{
						//loop for the number of classes on classesone.php
						for($i=0; $i<sizeof($classes_one); $i++)
						{
							//if the class needed is the class being looked at, $row['REQUIREMENTS'] = 'CS010' and $result1[$i] = 'CS010'
							if($result1[$i] == $row['REQUIREMENTS'])
							{
								//assign the class needed to the class array
								//$classArr[1] = $row['REQUIREMENTS'] = 'CS010'
								$classArr[$testcount] = $row['REQUIREMENTS'];
								//assign that class's avaiblility (FWS) to avaArr 
								$avaArr[$row['REQUIREMENTS']] = $row['AVAILABLE'];
								///assign that class's rereq to preArr
								$preArr[$row['REQUIREMENTS']] = $row['PREREQ'];
								//increment testcount, this is so the classes needed are assigned linearly, EX, classArr[0] = 'CS061' then if the next class needed is PHYS040A then classArr[1] = 'PHYS040A'
								$testcount = $testcount + 1;
							}
						}
					}
				
					//was thinking about doing the upper divs and lower divs seperately, dont know how to go about it so but it behaves the same way as the top
					//just assigns all the courses needed into and array 
					$schedule2 = $conn->query($sql);
					$classArr2 = [];	
					$avaArr2 = [];	
					$testcount2 = 0;
					$preArr2 = [];
					while($row = $schedule2->fetch_assoc())
					{
						for($i=0; $i<sizeof($classes_two); $i++)
						{
							if($result2[$i] == $row['REQUIREMENTS'])
							{
								$classArr2[$testcount2] = $row['REQUIREMENTS'];
								$avaArr2[$row['REQUIREMENTS']] = $row['AVAILABLE'];	
								$preArr2[$row['REQUIREMENTS']] = $row['PREREQ'];
								//echo '<br>';
								//echo 'Class: '.$classArr2[$testcount2].'available: '.$avaArr2[$row['REQUIREMENTS']].' prereq: '.$preArr2[$row['REQUIREMENTS']].'<br>';
								$testcount2 = $testcount2 + 1;
							}
						}
					}
			
					
					//no use for testingArr
					$testingArr = [];
					//classes to be taken in fall
					$fallArr = [];
					//classes to be taaken in winter
					$winterArr= [];
					//classes to be taken in spring
					$springArr = [];
		
					//counts the number of classes in fall winter and spring
					$fallcount = 0;
					$wintercount = 0;
					$springcount = 0;
					
					
					for($i=0; $i<sizeof($classArr); $i++)
					{
						$assigned = '0';
						//makes sure the prerequisite has been taken
						//if( (in_array($preArr[$classArr[$i]], $selected_one)) or (in_array($preArr[$classArr[$i]], $fallArr)) or (in_array($preArr[$classArr[$i]], $winterArr)) or (in_array($preArr[$classArr[$i]], $springArr)) )
					//	{
							
							//if class can be taken in the fall
							$mystring = $avaArr[$classArr[$i]];
							$findme = 'F';
							$pos = strpos($mystring, $findme);	
							if( ($pos === false))
							{
								;
							}
							else if($assigned == '0' and !( in_array($preArr[$classArr[$i]], $fallArr) ) and $fallcount <4 )
							{		
								if( in_array($preArr[$preArr[$classArr[$i]]], $fallArr) )
								{
									
								}
								else{
										$assigned = '1';
											
										//echo 'take: '. $classArr[$i] .' FALL  <br>';
										$fallcount++;
										array_push($fallArr11, 'Fall 2019: ' .$classArr[$i]. '.');
										array_push($fallArr, $classArr[$i]);
								}
								
							}
							else if($fallcount >= 4 and $assigned == '0' and $fallcount<8 and !( in_array($preArr[$classArr[$i]], $fallArr) ) )
							{
									if( in_array($preArr[$preArr[$classArr[$i]]], $fallArr) )
									{
											
									}
									else{
										$assigned = '1';
												
										//echo 'take: '. $classArr[$i] .' FALL  <br>';
										$fallcount++;
										array_push($fallArr11, 'Fall 2020: '.$classArr[$i]. '.');
										array_push($fallArr, $classArr[$i]);
									}
							}
							
							
							
							
							//if class can be taken in the winter
							$mystring = $avaArr[$classArr[$i]];
							$findme = 'W';
							$pos = strpos($mystring, $findme);	
							if( ($pos === false))
							{
								
							}
							else if($assigned == '0' and !( in_array($preArr[$classArr[$i]], $winterArr) ) and $wintercount <4)
							{
								if( in_array($preArr[$preArr[$classArr[$i]]], $winterArr) )
								{
									
								}
								else{
										$assigned = '1';
										
										//echo 'take: '. $classArr[$i] .' FALL  <br>';
										$wintercount++;
										array_push($winterArr11, 'Winter 2020: ' .$classArr[$i]. '.');
										array_push($winterArr, $classArr[$i]);
								}
							}
							else if($wintercount >= 4 and $assigned == '0' and $wintercount<8 and !(in_array($preArr[$classArr[$i]], $winterArr)))
							{
								if( in_array($preArr[$preArr[$classArr[$i]]], $winterArr) )
								{
									
								}
								else{
										$assigned = '1';
											
										//echo 'take: '. $classArr[$i] .' FALL  <br>';
										$wintercount++;
										array_push($winterArr11, 'Winter 2021: ' .$classArr[$i]. '.');
										array_push($winterArr, $classArr[$i]);
								}
							}
							
							
							
							
							
							
							//if class can be taken in the spring 
							$mystring = $avaArr[$classArr[$i]];
							$findme = 'S';
							$pos = strpos($mystring, $findme);	
							if( ($pos === false))
							{
								
							}
							else if($assigned == '0' and !( in_array($preArr[$classArr[$i]], $springArr) ) and $springcount < 4)
							{
								if( in_array($preArr[$preArr[$classArr[$i]]], $springArr) )
								{
									
								}
								else{
										$assigned = '1';
											
										//echo 'take: '. $classArr[$i] .' FALL  <br>';
										$springcount++;
										array_push($springArr11, 'Spring 2020: ' .$classArr[$i]. '.');
										array_push($springArr, $classArr[$i]);
								}
							}
							else if($springcount >= 4 and $assigned == '0' and $springcount<8 and !(in_array($preArr[$classArr[$i]], $springArr)))
							{
								if( in_array($preArr[$preArr[$classArr[$i]]], $springArr) )
								{

								}
								else{
										$assigned = '1';
											
										//echo 'take: '. $classArr[$i] .' FALL  <br>';
										$springcount++;
										array_push($springArr11, 'Spring 2021: ' .$classArr[$i]. '.');
										array_push($springArr, $classArr[$i]);
								}
							}
						
						}
					
					
					foreach($fallArr11 as &$value)
					{
						echo $value;
						
					}
					foreach($winterArr11 as &$value)
					{
						echo $value;
						
					}
					foreach($springArr11 as &$value)
					{
						echo $value;
						
					}
					
					
					/*
					
					foreach($fallArr2 as &$value)
					{
						echo $value;
						echo '<br>';
					}
					foreach($winterArr2 as &$value)
					{
						echo $value;
						echo '<br>';
					}
					foreach($springArr2 as &$value)
					{
						echo $value;
						echo '<br>';
					}
					
					
					
					
					if(!empty($result1))
					{		
						$result1size =  sizeof($result1);	
						
					}
					if(!empty($result2))
					{
						
						$result2size = sizeof($result2);
					}
					if(!empty($result3))
					{
						
						$result3size = sizeof($result3);
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

