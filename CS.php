<?php
session_start();

$selected_one = $_SESSION['selected_one_cookie'];
$selected_two = $_SESSION['selected_two_cookie'];
$selected_three = $_SESSION['selected_three_cookie'];

$classes_one = $_SESSION['classes_one_cookie'];
$classes_two = $_SESSION['classes_two_cookie'];
$classes_three = $_SESSION['classes_three_cookie'];

$senior_design = $_SESSION['senior_design_cookie'];
$email = $_SESSION['user'];

if($_SESSION['user'] == '0')
{

	echo '<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;';
}

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
		<div class="container2-login100" style="/*padding-top: 65px;*/">
			<div class="wrap-login100">
				

				
				
					<span class="login100-form-title">
						Computer Science
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

								$result1 = [];
								if(empty($selected_one))
								{
									$result1 = $classes_one;
								}
								else
								{
									$result1 = array_diff($classes_one, $selected_one);
								}
													
								$result2 = [];
								if(empty($selected_two))
								{
									$result2 = $classes_two;
								}
								else
								{
									$result2 = array_diff($classes_two, $selected_two);
								}
						
								
								$result3 = [];
								if(empty($selected_three))
								{
									$result3 = $classes_three;
								}
								else
								{
									$result3 = array_diff($classes_three, $selected_three);
								}
					
					$taken_classes = array();
				
					$taken_classes = array_merge((array)$selected_one, (array)$selected_two);
				
					
					$sqlmust = "SELECT * FROM CS WHERE MUST='1';";
					
					$mustArr = array(); //Must take in course plan
					$classAvailableArr = array(); //When available FWS
					$REQArr = array(); //PreReqs for each course
					$numREQ = array(); //nunber of pre reqs
					$techArr = array(); //tech classes array
					$techNum = 0;
					
					
					$return =  $conn->query($sqlmust);
					
					$testcount = 0;
					while($row = $return->fetch_assoc())
					{
						for($i=0; $i<sizeof($classes_one); $i++)
						{
							if($result1[$i] == $row['REQUIREMENTS'])
							{
								$mustArr[$testcount] = $row['REQUIREMENTS'];
								$classAvailableArr[$row['REQUIREMENTS']] = $row['AVAILABLE'];
								
								
								//array_push($REQArr, [$row['REQUIREMENTS']], $row['PREREQ1'], $row['PREREQ2'], $row['PREREQ3'], $row['PREREQ4'] );
								//array_push($REQArr[$row['REQUIREMENTS']], $row['PREREQ1'], $row['PREREQ2'], $row['PREREQ3'], $row['PREREQ4'] );
								$size = $row['REQS'];
								
								$size = (int)$size;
								$numREQ[$row['REQUIREMENTS']] = $size;
								if($size == 0)
								{
									$REQArr[$row['REQUIREMENTS']][0] = $row['PREREQ1'];
								}
								else{
									for($j=1; $j<$size+1; $j++)
									{

										$REQArr[$row['REQUIREMENTS']][$j-1] = $row["PREREQ{$j}"];
									}
								}

								
								
								
								
								$testcount = $testcount + 1;
							
							}
						}
						
						for($i=0; $i<sizeof($classes_two); $i++)
						{
							if($result2[$i] == $row['REQUIREMENTS'])
							{
								$mustArr[$testcount] = $row['REQUIREMENTS'];
								$classAvailableArr[$row['REQUIREMENTS']] = $row['AVAILABLE'];	
								
								$size = $row['REQS'];
								
								$size = (int)$size;
								$numREQ[$row['REQUIREMENTS']] = $size;
								if($size == 0)
								{
									$REQArr[$row['REQUIREMENTS']][0] = $row['PREREQ1'];
								}
								else{
									for($j=1; $j<$size+1; $j++)
									{

										$REQArr[$row['REQUIREMENTS']][$j-1] = $row["PREREQ{$j}"];
									}
								}

								
								
								$testcount = $testcount + 1;
							
							}
						}
						
						
						
					}
					
					$testcount = 0;
					$sqlmust = "SELECT * FROM CS WHERE MUST='0';";
					$return =  $conn->query($sqlmust);
					
					//$testcount = 0;
					while($row = $return->fetch_assoc())
					{
							if($senior_design == $row['REQUIREMENTS']){
								$classAvailableArr[$row['REQUIREMENTS']] = $row['AVAILABLE'];
								$size = $row['REQS'];

								$size = (int)$size;
								$numREQ[$row['REQUIREMENTS']] = $size;
								
								for($j=1; $j<$size+1; $j++)
								{

									$REQArr[$row['REQUIREMENTS']][$j-1] = $row["PREREQ{$j}"];
								}
								

							}
							else if($row['SD']== '1')
							{
								
							}						
							else
							{							
									$techArr[$testcount] = $row['REQUIREMENTS'];	
									$classAvailableArr[$row['REQUIREMENTS']] = $row['AVAILABLE'];	
									$size = $row['REQS'];

									$size = (int)$size;
									$numREQ[$row['REQUIREMENTS']] = $size;

									for($j=1; $j<$size+1; $j++)
									{

										$REQArr[$row['REQUIREMENTS']][$j-1] = $row["PREREQ{$j}"];
									}
									if( in_array($techArr[$testcount], $selected_two))
									{
										$techNum++;
								    }

							}
								
								$testcount++;
								
								
					}
					
					if( in_array($REQArr[$senior_design][0], $mustArr)){
						array_push($mustArr, $senior_design );
					}
					else{
						array_push($mustArr, $REQArr[$senior_design][0] );
						array_push($mustArr, $senior_design );
					}
					
					
					if (($key = array_search($REQArr[$senior_design][0], $techArr)) !== false)
					{
							unset($techArr[$key]);	
							$techNum++;
					}
					
					
					/*
								for($i=0; $i<$numREQ[$class]; $i++)
								{
									 
									echo $REQArr[$class][$i].' ';
								}
					
					*/
					
					
					//ASSIGN BREATH CLASSES
					
					
					$sqlbreath = "SELECT * FROM BREATH;";
					
					$breathArray = array(); //Must take in course plan
					
					$return =  $conn->query($sqlbreath);
					
					$breathcount = 0;
					while($row = $return->fetch_assoc())
					{
						for($i=0; $i<sizeof($classes_three); $i++)
						{
							if($result3[$i] == $row['REQUIREMENTS'])
							{
								$breathArray[$breathcount] = $row['REQUIREMENTS'];
								$classAvailableArr[$row['REQUIREMENTS']] = $row['AVAILABLE'];
								$breathcount = $breathcount + 1;
							
							}
						}
					}
					
					
					
					
					
					
					
					//

					$fall19 = array();
					$winter20 = array();
					$spring20 = array();
					
					
					
					$fall20 = array();
					$winter21 = array();
					$spring21 = array();
					
					
					
					
					$fall21 = array();
					$winter22 = array();
					$spring22 = array();
					
					
					
					$fall22 = array();
					$winter23 = array();
					$spring23 = array();
					
					
					$year1 = array();
					$year2 = array();
					$year3 = array();
					$year4 = array();
					
					$fallcount = 0;
					$wintercount = 0;
					$springcount = 0;
					
					$fallcount2 = 0;
					$wintercount2 = 0;
					$springcount2 = 0;
					
					$fallcount3 = 0;
					$wintercount3 = 0;
					$springcount3 = 0;
					
					$fallcount4 = 0;
					$wintercount4 = 0;
					$springcount4 = 0;
				
					
					$year1_full = false;
					$year2_full = false;
					$year3_full = false;
					$year4_full = false;
					
					//first check to see if we can assign classes that have no prereqs to thier schedule
					foreach($mustArr as &$currClass)
					{		$assigned = false;
							//Year one ===================================================================================
					 		while(!$assigned)
							{
								
									//Fall
									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount < 4 )
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $year1) or in_array($REQArr[$currClass][$j], $year2) or in_array($REQArr[$currClass][$j], $year3) or in_array($REQArr[$currClass][$j], $year4) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}
												
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$fallcount++;
													array_push($fall19, $currClass);
													array_push($year1, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											}

										}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount < 4 )
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $winter20) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$wintercount++;
													array_push($winter20, $currClass);
													array_push($year1, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}

									//Spring
									
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount < 4 )
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $spring20) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$springcount++;
													array_push($spring20, $currClass);
													array_push($year1, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}
								

									
								
								//============================================================================================

								//Year two ===================================================================================
								
								//Fall

									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount2 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $year2) or in_array($REQArr[$currClass][$j], $year3) or in_array($REQArr[$currClass][$j], $year4) )
												{
													$concurrent = true;
												}
												
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$fallcount2++;
													array_push($fall20, $currClass);
													array_push($year2, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											}

										}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount2 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $winter21) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $spring21))
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$wintercount2++;
													array_push($winter21, $currClass);
													array_push($year2, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}
								
									//Spring
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount2 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $spring21) )
												{
													$concurrent = true;
												}
												
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$springcount2++;
													array_push($spring21, $currClass);
													array_push($year2, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}
								
								

									

									
								
								//============================================================================================

								//Year three =================================================================================
								//Fall
									
									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount3 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;											
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if(in_array($REQArr[$currClass][$j], $year3) or in_array($REQArr[$currClass][$j], $year4) )
												{
													$concurrent = true;											
												}
												
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$fallcount3++;
													array_push($fall21, $currClass);
													array_push($year3, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											}

										}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount3 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $winter22) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $spring22))
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$wintercount3++;
													array_push($winter22, $currClass);
													array_push($year3, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}

									//Spring
								
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount3 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $spring22) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$springcount3++;
													array_push($spring22, $currClass);
													array_push($year3, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}
									
							

								//============================================================================================

								//Year four ==================================================================================
							
								//Fall
									
									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount4 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $fall22) )
												{
													$concurrent = true;
												}
												if(in_array($REQArr[$currClass][$j], $year4))
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$fallcount4++;
													array_push($fall22, $currClass);
													array_push($year4, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											}

										}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount4 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $winter23) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $spring23))
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$wintercount4++;
													array_push($winter23, $currClass);
													array_push($year4, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}

									//Spring
								
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount4 < 4)
										{				
											$concurrent = false;
											$taken = false;
											$selectedcount = 0;
											for($j=0; $j<$numREQ[$currClass]; $j++)
											{
												if( in_array($REQArr[$currClass][$j], $spring23) )
												{
													$concurrent = true;
												}
												if( in_array($REQArr[$currClass][$j], $taken_classes))
												{
													$selectedcount++;
												}										
											}
											if($selectedcount == $numREQ[$currClass])
											{
												$taken = true;
											}
											if(!$concurrent and $taken)
											{
													
													$springcount4++;
													array_push($spring23, $currClass);
													array_push($year4, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											}

										}

									}
									
								$assigned = true;
								break;

									
								
								//============================================================================================
							}
							

					}
					
					
				
					//////TECHS GET ASSGINED HEREE
					
						foreach($techArr as &$currClass)
						{		$assigned = false;
								//Year one ===================================================================================
								while(!$assigned)
								{

										//Fall
										$mystring = $classAvailableArr[$currClass];
										$findme = 'F';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if($assigned==false)
										{
											if($fallcount < 4 )
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $year1) or in_array($REQArr[$currClass][$j], $year2) or in_array($REQArr[$currClass][$j], $year3) or in_array($REQArr[$currClass][$j], $year4) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}

												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$fallcount++;
														$techNum++;
														array_push($fall19, $currClass);
														array_push($year1, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;
												}

											}
										}

										//Winter
										$mystring = $classAvailableArr[$currClass];
										$findme = 'W';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false )
										{
											if($wintercount < 4 )
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $winter20) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$wintercount++;
														$techNum++;
														array_push($winter20, $currClass);
														array_push($year1, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}

										//Spring

										$mystring = $classAvailableArr[$currClass];
										$findme = 'S';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false)
										{
											if($springcount < 4 )
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $spring20) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$springcount++;
														$techNum++;
														array_push($spring20, $currClass);
														array_push($year1, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}




									//============================================================================================

									//Year two ===================================================================================

									//Fall

										$mystring = $classAvailableArr[$currClass];
										$findme = 'F';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if($assigned==false)
										{
											if($fallcount2 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $year2) or in_array($REQArr[$currClass][$j], $year3) or in_array($REQArr[$currClass][$j], $year4) )
													{
														$concurrent = true;
													}

													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$fallcount2++;
														$techNum++;
														array_push($fall20, $currClass);
														array_push($year2, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;
												}

											}
										}

										//Winter
										$mystring = $classAvailableArr[$currClass];
										$findme = 'W';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false )
										{
											if($wintercount2 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $winter21) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $spring21))
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$wintercount2++;
														$techNum++;
														array_push($winter21, $currClass);
														array_push($year2, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}

										//Spring
										$mystring = $classAvailableArr[$currClass];
										$findme = 'S';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false)
										{
											if($springcount2 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $spring21) )
													{
														$concurrent = true;
													}

													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$springcount2++;
														$techNum++;
														array_push($spring21, $currClass);
														array_push($year2, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}







									//============================================================================================

									//Year three =================================================================================
									//Fall

										$mystring = $classAvailableArr[$currClass];
										$findme = 'F';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if($assigned==false)
										{
											if($fallcount3 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if(in_array($REQArr[$currClass][$j], $year3) or in_array($REQArr[$currClass][$j], $year4) )
													{
														$concurrent = true;
													}

													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$fallcount3++;
														$techNum++;
														array_push($fall21, $currClass);
														array_push($year3, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;
												}

											}
										}

										//Winter
										$mystring = $classAvailableArr[$currClass];
										$findme = 'W';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false )
										{
											if($wintercount3 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $winter22) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $spring22))
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$wintercount3++;
														$techNum++;
														array_push($winter22, $currClass);
														array_push($year3, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}

										//Spring

										$mystring = $classAvailableArr[$currClass];
										$findme = 'S';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false)
										{
											if($springcount3 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $spring22) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$springcount3++;
														$techNum++;
														array_push($spring22, $currClass);
														array_push($year3, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}



									//============================================================================================

									//Year four ==================================================================================

									//Fall

										$mystring = $classAvailableArr[$currClass];
										$findme = 'F';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if($assigned==false)
										{
											if($fallcount4 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $fall22) )
													{
														$concurrent = true;
													}
													if(in_array($REQArr[$currClass][$j], $year4))
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$fallcount4++;
														$techNum++;
														array_push($fall22, $currClass);
														array_push($year4, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;
												}

											}
										}

										//Winter
										$mystring = $classAvailableArr[$currClass];
										$findme = 'W';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false )
										{
											if($wintercount4 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $winter23) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $spring23))
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$wintercount4++;
														$techNum++;
														array_push($winter23, $currClass);
														array_push($year4, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}

										//Spring

										$mystring = $classAvailableArr[$currClass];
										$findme = 'S';
										$pos = strpos($mystring, $findme);	
										if( ($pos === false))
										{

										}
										else if( $assigned==false)
										{
											if($springcount4 < 4)
											{				
												$concurrent = false;
												$taken = false;
												$selectedcount = 0;
												for($j=0; $j<$numREQ[$currClass]; $j++)
												{
													if( in_array($REQArr[$currClass][$j], $spring23) )
													{
														$concurrent = true;
													}
													if( in_array($REQArr[$currClass][$j], $taken_classes))
													{
														$selectedcount++;
													}										
												}
												if($selectedcount == $numREQ[$currClass])
												{
													$taken = true;
												}
												if(!$concurrent and $taken)
												{

														$springcount4++;
														$techNum++;
														array_push($spring23, $currClass);
														array_push($year4, $currClass);
														array_push($taken_classes, $currClass);
														$assigned = true;
														break;

												}

											}

										}

									$assigned = true;
									break;



									//============================================================================================
								}
						 	if($techNum > 6)
							{
								break;
							}

						}
					
					
//BREADTH ASSIGNED HERE=================================================================================================================================				
					
					
					foreach($breathArray as &$currClass)
					{		$assigned = false;
							//Year one ===================================================================================
					 		while(!$assigned)
							{
								
									//Fall
									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount < 4 )
										{								
													$fallcount++;
													array_push($fall19, $currClass);
													array_push($year1, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount < 4 )
										{				
											
													
													$wintercount++;
													array_push($winter20, $currClass);
													array_push($year1, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

						

										}

									}

									//Spring
									
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount < 4 )
										{				
											
													
													$springcount++;
													array_push($spring20, $currClass);
													array_push($year1, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											

										}

									}
								

									
								
								//============================================================================================

								//Year two ===================================================================================
								
								//Fall

									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount2 < 4)
										{				
											
													
													$fallcount2++;
													array_push($fall20, $currClass);
													array_push($year2, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											

										}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount2 < 4)
										{				
											
											
													
													$wintercount2++;
													array_push($winter21, $currClass);
													array_push($year2, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											

										}

									}
								
									//Spring
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount2 < 4)
										{				
											
													$springcount2++;
													array_push($spring21, $currClass);
													array_push($year2, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											

										}

									}
								
								

									

									
								
								//============================================================================================

								//Year three =================================================================================
								//Fall
									
									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount3 < 4)
										{				
											
													
													$fallcount3++;
													array_push($fall21, $currClass);
													array_push($year3, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											

										}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount3 < 4)
										{				
											
													
													$wintercount3++;
													array_push($winter22, $currClass);
													array_push($year3, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											

										}

									}

									//Spring
								
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount3 < 4)
										{				
											
													
													$springcount3++;
													array_push($spring22, $currClass);
													array_push($year3, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;


										}

									}
									
							

								//============================================================================================

								//Year four ==================================================================================
							
								//Fall
									
									$mystring = $classAvailableArr[$currClass];
									$findme = 'F';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if($assigned==false)
									{
										if($fallcount4 < 4)
										{				
											
													$fallcount4++;
													array_push($fall22, $currClass);
													array_push($year4, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;
											

										}
									}

									//Winter
									$mystring = $classAvailableArr[$currClass];
									$findme = 'W';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false )
									{
										if($wintercount4 < 4)
										{				
											
													
													$wintercount4++;
													array_push($winter23, $currClass);
													array_push($year4, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											

										}

									}

									//Spring
								
									$mystring = $classAvailableArr[$currClass];
									$findme = 'S';
									$pos = strpos($mystring, $findme);	
									if( ($pos === false))
									{

									}
									else if( $assigned==false)
									{
										if($springcount4 < 4)
										{				
											
													
													$springcount4++;
													array_push($spring23, $currClass);
													array_push($year4, $currClass);
													array_push($taken_classes, $currClass);
													$assigned = true;
													break;

											

										}

									}
									
								$assigned = true;
								break;

									
								
								//============================================================================================
							}
							

					}
					
					echo '<div class="container" style="text-align: center; padding-bottom: 45px;">';
					
				
					///////////////////////////////
					$CoursePlan = array();
					
					echo ' <div class="row">';
					echo '<div class="col-sm-4">';
					echo '<h4>Fall 19</h4>';
					echo '<p>';
					foreach($fall19 as &$currClass)
					{
						//echo 'fall 19: '.$currClass .'  <br>';
						echo $currClass .'<br>';
						//if($counter == 1){
						//	array_push($CoursePlan,'Fall 19: '.$currClass );
						//}
						//else{
							array_push($CoursePlan,'Fall 19: '.$currClass );
						
						//}
						//$counter++;
						 
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
						array_push($CoursePlan,'Winter 20: '.$currClass); 
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
						array_push($CoursePlan,'Spring 20: '.$currClass);
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
						array_push($CoursePlan,'Fall 20: '.$currClass);
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
						array_push($CoursePlan,'Winter 21: '.$currClass);
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
						array_push($CoursePlan,'Spring 21: '.$currClass );
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
						array_push($CoursePlan,'Fall 21: '.$currClass);
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
						array_push($CoursePlan,'Winter 22: '.$currClass);
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
						array_push($CoursePlan,'Spring 22: '.$currClass);
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
						array_push($CoursePlan,'Fall 22: '.$currClass);
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
						array_push($CoursePlan,'Winter 23: '.$currClass);
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
						array_push($CoursePlan,'Spring 23: '.$currClass);
					}
				echo '</p>';
					echo '</div>';
				
				echo '</div>';
					echo '</div>';
				
				//echo '</div>';
				
				
					
					$myObj->F19 = $fall19;
					$myObj->W20 = $winter20;
					$myObj->S20 = $spring20;
					$myObj->F20 = $fall20;
					$myObj->W21 = $winter21;
					$myObj->S21 = $spring21;
					$myObj->F21 = $fall21;
					$myObj->W22 = $winter22;
					$myObj->S22 = $spring22;
					$myObj->F22 = $fall22;
					$myObj->W23 = $winter23;
					$myObj->S23 = $spring23;
				
				
					$myJSON = json_encode($myObj);

					//echo $myJSON;
				//	echo '<br>';
				//echo '<br>';
				//echo '<br>';
				
				//	$myJSON2 = json_decode($myJSON);
					
				//	$fallarrr = $myJSON2->F19;
				//	foreach($fallarrr as &$val){
				//		echo $val.'<br>';
				//	}
				
					
				//	$plan = json_encode($CoursePlan);
					$sql = "UPDATE ACCOUNTS SET COURSEPLAN ='".$myJSON."' WHERE EMAIL='".$email."';";
					$return =  $conn->query($sql);
					
				
							
							mysqli_close($conn);
							?>
				
            
		
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
