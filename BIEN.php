<?php
session_start();
$selected_one = $_SESSION['selected_one_cookie'];
$selected_two = $_SESSION['selected_two_cookie'];
$selected_three = $_SESSION['selected_three_cookie'];

$classes_one = $_SESSION['classes_one_cookie'];
$classes_two = $_SESSION['classes_two_cookie'];
$classes_three = $_SESSION['classes_three_cookie'];
if($_SESSION['user'] == '0')
{

	echo '<meta http-equiv="Refresh" content="0; URL = Login-Page.php"/>;';
}

?>
<!doctype html>

<html lang="en">
<head>
	
	<title>Bio Engineering</title>
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
						Bio Engineering
					</span>
					
					<?php
								class node { //This class is used to store every class.
									public $title = ''; //Name of class
									public $requires = array(); //Array of all requirements to take this class
									public $availability = ''; //FWS availability of class

									//Functions to change the above as needed
									function add($input) { 
										array_push($this->requires, $input);
									}
									function ava($input) {
										$this->availability = $input;
									}
									function name($input) {
										$this->title = $input;
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
					


								$sqlQuery1 = "SELECT * FROM BIEN WHERE PREREQ IS NULL;";
								$sqlQuery2 = "SELECT * FROM BIEN WHERE PREREQ IS NOT NULL;";
								//Note that BIEN's table has been modified to have an extra column for prereqs, where classes with no prereqs are just null
								$noPrereq = $conn->query($sqlQuery1); //get all classes that need no prereq
								$hasPrereq = $conn->query($sqlQuery2); // get all classes that have a prereq

								$reqTree = array();

								while($row = $noPrereq->fetch_assoc()) { //Initially populate the tree with non prereq classes
									for($i=0; $i<sizeof($result1); $i++){
										if($result1[$i] == row['REQUIREMENTS']) {
											$newNode = node(); //Create a new node
											$newNode->name($row['REQUIREMENTS']); //name it the name of the class
											$newNode->ava($row['AVAILABLE']); //Add when it's available (FWS)
											array_push($reqTree, $newNode);// Add it to the reqTree array
										}
									}
								}
								while($row = $noPrereq->fetch_assoc()) { //Initially populate the tree with non prereq classes
									for($i=0; $i<sizeof($result2); $i++){
										if($result2[$i] == row['REQUIREMENTS']) {
											$newNode = node();
											$newNode->name($row['REQUIREMENTS']);
											$newNode->ava($row['AVAILABLE']);
											array_push($reqTree, $newNode);
										}
									}
								}


								//Populate the requirement tree with classes that have prerequisites.
								//Each class stores an array of previously added nodes into the array "requires" based on what's stored in PREREQ
								//Note that additional prerequisite classes are comma separated.
								while($row = $hasPrereq->fetch_assoc()) {
									for($i=0; $i<sizeof($result1);$i++) {
										if($result1[$i] == row['REQUIREMENTS']) {
											$newNode = node();
											$newNode->name($row['REQUIREMENTS']);
											$newNode->ava($row['AVAILABLE']);
											$allPre = explode("," , row['PREREQ']); //Ex: "CS010,CS012,CS014" -> array("CS010", "CS012", "CS014");
											for($j=0; $j<sizeof($allPre);$j++) { //For each prerequisite class
												$curString = $allPre[$j];//Get th ename of the prerequisite class
												for($k=0; $k<sizeof($reqTree);$k++) { //Search through the previously added nodes
													if($reqTree[k]->title == $curString) {//for a title = to the class needed
														$newNode->add($reqTree[k]); //Add that node as a requirement
													}
												}
											}
											array_push($reqTree, $newNode); //Push the new node
										}
									}
								}
								while($row = $hasPrereq->fetch_assoc()) {
									for($i=0; $i<sizeof($result2);$i++) {
										if($result2[$i] == row['REQUIREMENTS']) {
											$newNode = node();
											$newNode->name($row['REQUIREMENTS']);
											$newNode->ava($row['AVAILABLE']);
											$allPre = explode("," , row['PREREQ']);
											for($j=0; $j<sizeof($allPre);$j++) {
												$curString = $allPre[$j];
												for($k=0; $k<sizeof($reqTree);$k++) {
													if($reqTree[k]->title == $curString) {
														$newNode->add($reqTree[k]);
													}
												}
											}
											array_push($reqTree, $newNode);
										}
									}
								}


								$fCnt = 0;
								$wCnt = 0;
								$sCnt = 0;
								$currYear = array();
								$totalSched = array(); //Should be in correct order
								while(!empty($reqTree)) { //Iterate through the tree backwards to put classes in order.
									$flag = ""; //Flag is ot keep track of which quarter a thing was put into
									$curQuarter = '';

									$curNode = $reqTree[sizeof($reqTree) - 1];

									//Find a spot to put the current class, preferring spring.
									$fall = array();
									$winter = array();
									$spring = array();

									if(strpos($curNode->availability, "S") && $flag) {
										if($sCnt < 4) {
											array_push($spring, $curNode);
											$flag = "S";
										}
									}
									if(strpos($curNode->availability, "W") && $flag) {
										if($wCnt < 4) {
											array_push($winter, $curNode);
											$flag = "W";
										}
									}

									if(strpos($curNode->availability, "F") && $flag) {
										if($fCnt < 4) {
											array_push($fall, $curNode);
											$flag = "F";
										}
									}

									if(!$flag) { //If flag hasn't been set to true, this means that we need to switch to a new year. Note that "" = false.
										$totalSched = $totalSched + $currYear;
										$currYear = array();
										$fCnt = 0;
										$wCnt = 0;
										$sCnt = 0;
										continue;
									}

									while(!empty($curNode->requires)) {
										$curPrereq = $curNode->requires[sizeof($curNode->requires) - 1]; //Get last node in requires array
										if($flag == "S") { //If the first node was pushed to spring, then try to push its requirements to fall or winter.
											if(strpos($curPrereq, "W") && wCnt < 4) {
												array_push($winter, $curPrereq);
												array_pop($curNode->requires);
												continue;
											}
											else if(strpos($curPrereq, "F") && fCnt < 4) {
												array_push($winter, $curPrereq);
												array_pop($curNode->requires);
												continue;
											}
											else { //If it wasn't available in fall or winter, or those were full just go to the next year.
												$totalSched = $totalSched + $currYear;
												$currYear = array();
												$fCnt = 0;
												$wCnt = 0;
												$sCnt = 0;
												//Note that since the array wasn't popped, it will try the same class again in the next year.
												continue;
											}
										}
										else if($flag == "W") {  
											if(strpos($curPrereq, "F") && fCnt < 4) {
												array_push($winter, $curPrereq);
												array_pop($curNode->requires);
												continue;
											}
											else {
												$totalSched = $totalSched + $currYear;
												$currYear = array();
												$fCnt = 0;
												$wCnt = 0;
												$sCnt = 0;
												continue;
											}
										}
										else if($flag == "F") {
												$totalSched = $totalSched + $currYear;
												$currYear = array();
												$fCnt = 0;
												$wCnt = 0;
												$sCnt = 0;
												continue;
										}
									}//End while(!empty($curNode->requires))

									array_pop($reqTree);

								}// end while(!empty($reqTree))

								$dSchedule = array(); //2d array where each member is an array of each year (Should be 16 classes).
								$cnt = 0;
								$year = array();
								while(!empty($totalSched) && sizeof($dSchedule) < 4) { //Break 
									$curClass = $totalSched[sizeof($totalSched) - 1];
									if($cnt < 12) {
										array_push($year, $curclass);
										$cnt++;
									}
									else {
										$cnt = 0;
										array_push($dSchedule, $year);
										$year = array();
									}
									array_pop($totalSched);
								}

							foreach($dSchedule as &$value){
								echo $value."<br>";
							}
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

