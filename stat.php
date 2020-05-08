<html>
	<head>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    
		<link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	<body>
		<img src="imgs/bg3.png" style="position: absolute; top: 0px; z-index: -1; height: 50%;" />
		<?php
			session_start();
			if (isset($_SESSION['id'])) {
		?>
		<table style="width: 80%; border: 0px; border: 0px solid #ddd; border-radius: 8px; background: #fff;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" border="0" cellpadding="20" cellspacing="0" align="center">
			<tr>
				<td style="width: 20%;">
					<center><a style="font-weight: 900; color: black; text-decoration: none;" href="main.php">Problem Solving</a></center>
				</td>
				<td style="width: 20%;">
					<center><a style="font-weight: 900; color: black; text-decoration: none;" href="interview.php">Interview</a></center>
				</td>
				<td style="width: 20%; ">
					<center><a style="font-weight: 900; color: black; text-decoration: none;" href="lecture.php">Lecture listening</a></center>
				</td>
				<td style="width: 20%;
							background: #00695c; 
							border-radius: 8px;">
					<center><a style="font-weight: 900; color: white; text-decoration: none;" href="stat.php">Statistics</a></center>
				</td>
				<td style="width: 20%;">
					<center><a style="font-weight: 900; color: black; text-decoration: none;" href="logoutController.php">Logout</a></center>
				</td>
			</tr>
		</table>
		<br/>
		<p style="font-size: 2em; font-weight: 100; position: relative; left: 10%;">
			<?php
				$monthNum = date("m");
			?>
			<strong><?php echo date("d");?></strong> <?php echo date('F', mktime(0, 0, 0, $monthNum, 10)) . ", 20" . date("y");?>
		</p>
		<p style="font-size: 1em; font-weight: 100; position: relative;left: 10%; top: -15px; color: #777;">
		    Hello, <strong><?php echo $_SESSION['username'];?> </strong> &#128075; 
		<br/>
		<h2 style="font-weight: 100; position: relative; left: 10%;">Preparation History</h2>
		<table cellpadding="10" cellspacing="10" style="width: 80%;" align="center">
			<tr>
				<td style="background: #ffecb3; border-radius: 8px;">
				    <p>Problem solved</p>
				</td>
				<td style="background: #ffccbc; border-radius: 8px;">
				    <p>Problem solved + Interview passed</p>
				</td>
				<td style="background: #cfd8dc; border-radius: 8px;">
				    <p>Problem solved + Interview passed + Lecture / Tutorial watched</p>
				</td>
			</tr>
			<tr>
				<td style="background: #ffcdd2; border-radius: 8px;">
				    <p>Interview passed</p>
				</td>
				<td style="background: #d1c4e9; border-radius: 8px;">
				    <p>Problem solved + Lecture / Tutorial watched</p>
				</td>
			</tr>
			<tr>
				<td style="background: #b3e5fc; border-radius: 8px;">
				    <p>Lecture / Tutorial watched</p>
				</td>
				<td style="background: #b2dfdb; border-radius: 8px;">
				    <p>Interview passed + Lecture / Tutorial watched</p>
				</td>
			</tr>
		</table>
		<br/>
		<table style="width: 80%; border-collapse: collapse; border: 1px solid #ccc;" border="0" cellpadding="10" align="center">
			<tr>
				<td width="8.3%">January</td>
				<td width="8.3%">February</td>
				<td width="8.3%">March</td>
				<td width="8.3%">April</td>
				<td width="8.3%">May</td>
				<td width="8.3%">June</td>
				<td width="8.3%">July</td>
				<td width="8.3%">August</td>
				<td width="8.3%">September</td>
				<td width="8.3%">October</td>
				<td width="8.3%">Novermber</td>
				<td width="8.3%">December</td>
			</tr>
		</table>
		<table style="width: 80%; border-collapse: collapse; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" border="1" cellpadding="10" align="center">
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "root";
				$dbname = "preptracker";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT * FROM problems WHERE user_id = " . $_SESSION['id'];
				$result = $conn->query($sql);

				$dates = array();
				$used = array();

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	$date = new DateTime($row['solved_date']);
				    	array_push($dates, $date->format('z') + 3);
				    	array_push($used, false);
				    }
				}

				$sql = "SELECT * FROM topic_session WHERE user_id = " . $_SESSION['id'];
				$result = $conn->query($sql);

				$lecture_dates = array();
				$used_lect = array();

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	$date = new DateTime($row['learned_date']);
				    	array_push($lecture_dates, $date->format('z') + 3);
				    	array_push($used_lect, false);
				    }
				}

				$sql = "SELECT * FROM interview WHERE user_id = " . $_SESSION['id'];
				$result = $conn->query($sql);

				$intr_dates = array();
				$used_intr = array();

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	$date = new DateTime($row['interview_date']);
				    	array_push($intr_dates, $date->format('z') + 3);
				    	array_push($used_intr, false);
				    }
				}

				$conn->close();

				$uniq_dates = array();
				$dates_cnt = array();

				for ($i = 0; $i < count($dates); $i++) {
				    if ($used[$i] == false) {
				    	$cnt = 0;
				    	for ($j = $i; $j < count($dates); $j++) {
							if ($dates[$i] == $dates[$j]) {
								$used[$j] = true;
								$cnt++;
							}
				    	}
				    	// echo $dates[$i] . ": " . $cnt . "<br/>";
				    	array_push($uniq_dates, $dates[$i]);
				    	array_push($dates_cnt, $cnt);
				    }
				}

				$uniq_dates_lect = array();
				$dates_cnt_lect = array();

				for ($i = 0; $i < count($lecture_dates); $i++) {
				    if ($used_lect[$i] == false) {
				    	$cnt = 0;
				    	for ($j = $i; $j < count($lecture_dates); $j++) {
							if ($lecture_dates[$i] == $lecture_dates[$j]) {
								$used_lect[$j] = true;
								$cnt++;
							}
				    	}
				    	array_push($uniq_dates_lect, $lecture_dates[$i]);
				    	array_push($dates_cnt_lect, $cnt);
				    }
				}

				$uniq_dates_intr = array();
				$dates_cnt_intr = array();

				for ($i = 0; $i < count($intr_dates); $i++) {
				    if ($used_intr[$i] == false) {
				    	$cnt = 0;
				    	for ($j = $i; $j < count($intr_dates); $j++) {
							if ($intr_dates[$i] == $intr_dates[$j]) {
								$used_intr[$j] = true;
								$cnt++;
							}
				    	}
				    	array_push($uniq_dates_intr, $intr_dates[$i]);
				    	array_push($dates_cnt_intr, $cnt);
				    }
				}
				// var_dump($uniq_dates_lect);
				// var_dump($dates_cnt_lect);

				// for ($i = 0; $i < 52; $i++) {
				// 	echo "<th style='font-size: 0.1em;'></th>";
				// }
				
				for ($i = 0; $i < 7; $i++) {
				    $cnt = $i + 1;
				    echo "<tr style='font-size: 0.1em;'>";
				    for ($j = 0; $j < 52; $j++) {
				    	$found = false;
				    	$problemFound = false;
				    	$lectFound = false;
				    	$intrFound = false;
				    	$problemCnt = 0;
				    	$lectCnt = 0;
				    	$intCnt = 0;
				    	for ($k = 0; $k < count($uniq_dates); $k++) {
							if ($uniq_dates[$k] == $cnt) {
								$found = true;
								$problemFound = true;
								$problemCnt = $dates_cnt[$k];
								break;
							}
				    	}

				    	for ($k = 0; $k < count($uniq_dates_lect); $k++) {
							if ($uniq_dates_lect[$k] == $cnt) {
								$found = true;
								$lectFound = true;
								$lectCnt = $dates_cnt_lect[$k];
								break;
							}
				    	}

				    	for ($k = 0; $k < count($uniq_dates_intr); $k++) {
							if ($uniq_dates_intr[$k] == $cnt) {
								$found = true;
								$intrFound = true;
								$intCnt = $dates_cnt_intr[$k];
								break;
							}
				    	}

				    	if ($problemFound == true && $lectFound == false && $intrFound == false && $problemCnt > 0 && $problemCnt <= 1) {
							echo "<td style='font-size: 0.1em; background: #ffecb3;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == false && $intrFound == false && $problemCnt > 1 && $problemCnt <= 2) {
							echo "<td style='font-size: 0.1em; background: #ffe082;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == false && $intrFound == false && $problemCnt > 2 && $problemCnt <= 3) {
							echo "<td style='font-size: 0.1em; background: #ffd54f;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == false && $intrFound == false && $problemCnt > 3) {
							echo "<td style='font-size: 0.1em; background: #ffca28;'></td>";
				    	}

				    	if ($problemFound == false && $lectFound == true && $intrFound == false && $lectCnt > 0 && $lectCnt <= 1) {
							echo "<td style='font-size: 0.1em; background: #b3e5fc;'></td>";
				    	}
				    	if ($problemFound == false && $lectFound == true && $intrFound == false && $lectCnt > 1 && $lectCnt <= 2) {
							echo "<td style='font-size: 0.1em; background: #81d4fa;'></td>";
				    	}
				    	if ($problemFound == false && $lectFound == true && $intrFound == false && $lectCnt > 2 && $lectCnt <= 3) {
							echo "<td style='font-size: 0.1em; background: #4fc3f7;'></td>";
				    	}
				    	if ($problemFound == false && $lectFound == true && $intrFound == false && $lectCnt > 3) {
							echo "<td style='font-size: 0.1em; background: #29b6f6;'></td>";
				    	}

				    	if ($problemFound == false && $intrFound == true && $lectFound == false && $intCnt > 0 && $intCnt <= 1) {
							echo "<td style='font-size: 0.1em; background: #ffcdd2;'></td>";
				    	}
				    	if ($problemFound == false && $intrFound == true && $lectFound == false && $intCnt > 1 && $intCnt <= 2) {
							echo "<td style='font-size: 0.1em; background: #ef9a9a;'></td>";
				    	}
				    	if ($problemFound == false && $intrFound == true && $lectFound == false && $intCnt > 2 && $intCnt <= 3) {
							echo "<td style='font-size: 0.1em; background: #e57373;'></td>";
				    	}
				    	if ($problemFound == false && $intrFound == true && $lectFound == false && $intCnt > 3) {
							echo "<td style='font-size: 0.1em; background: #ef5350;'></td>";
				    	}

				    	if ($problemFound == true && $lectFound == true && $intrFound == false && $problemCnt * $lectCnt > 0 && $problemCnt * $lectCnt <= 1) {
							echo "<td style='font-size: 0.1em; background: #d1c4e9;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == true && $intrFound == false && $problemCnt * $lectCnt > 1 && $problemCnt * $lectCnt <= 4) {
							echo "<td style='font-size: 0.1em; background: #b39ddb;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == true && $intrFound == false && $problemCnt* $lectCnt > 4 && $problemCnt * $lectCnt <= 9) {
							echo "<td style='font-size: 0.1em; background: #9575cd;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == true && $intrFound == false && $problemCnt * $lectCnt > 9) {
							echo "<td style='font-size: 0.1em; background: #7e57c2;'></td>";
				    	}

				    	if ($problemFound == true && $lectFound == false && $intrFound == true && $problemCnt * $intCnt > 0 && $problemCnt * $intCnt <= 1) {
							echo "<td style='font-size: 0.1em; background: #ffccbc;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == false && $intrFound == true && $problemCnt * $intCnt > 1 && $problemCnt * $intCnt <= 4) {
							echo "<td style='font-size: 0.1em; background: #ffa4a2;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == false && $intrFound == true && $problemCnt * $intCnt > 4 && $problemCnt * $intCnt <= 9) {
							echo "<td style='font-size: 0.1em; background: #ff867c;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == false && $intrFound == true && $problemCnt * $intCnt > 9) {
							echo "<td style='font-size: 0.1em; background: #ff7961;'></td>";
				    	}

				    	if ($problemFound == false && $lectFound == true && $intrFound == true && $lectCnt * $intCnt > 0 && $lectCnt * $intCnt <= 1) {
							echo "<td style='font-size: 0.1em; background: #b2dfdb;'></td>";
				    	}
				    	if ($problemFound == false && $lectFound == true && $intrFound == true && $lectCnt * $intCnt > 1 && $lectCnt * $intCnt <= 4) {
							echo "<td style='font-size: 0.1em; background: #80cbc4;'></td>";
				    	}
				    	if ($problemFound == false && $lectFound == true && $intrFound == true && $lectCnt * $intCnt > 4 && $lectCnt * $intCnt <= 9) {
							echo "<td style='font-size: 0.1em; background: #4db6ac;'></td>";
				    	}
				    	if ($problemFound == false && $lectFound == true && $intrFound == true && $lectCnt * $intCnt > 9) {
							echo "<td style='font-size: 0.1em; background: #26a69a;'></td>";
				    	}

				    	if ($problemFound == true && $lectFound == true && $intrFound == true && $problemCnt * $lectCnt * $intCnt > 0 && $problemCnt * $lectCnt * $intCnt <= 1) {
							echo "<td style='font-size: 0.1em; background: #d1c4e9;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == true && $intrFound == true && $problemCnt * $lectCnt * $intCnt > 1 && $problemCnt * $lectCnt * $intCnt <= 4) {
							echo "<td style='font-size: 0.1em; background: #b39ddb;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == true && $intrFound == true && $problemCnt * $lectCnt * $intCnt > 4 && $problemCnt * $lectCnt * $intCnt <= 9) {
							echo "<td style='font-size: 0.1em; background: #9575cd;'></td>";
				    	}
				    	if ($problemFound == true && $lectFound == true && $intrFound == true && $problemCnt * $lectCnt * $intCnt > 9) {
							echo "<td style='font-size: 0.1em; background: #7e57c2;'></td>";
				    	}

				    	if ($found == false)
					    	echo "<td style='font-size: 0.1em;'></td>";

					    $cnt += 7;
					}
					echo "</tr>";
				}
			?>
		</table>
		<br/>
		<br/>
		<h2 style="font-weight: 100; position: relative; left: 10%;">Statistics by problem diffculcy</h2>
		<table style="width: 80%; border: 0px solid #ccc;" border="0" align="center" cellspacing="20">
			<tr>
				<td style="width: 50%; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="piechart_3d"></div>
				</td>
				<td valign="top" style="padding: 20px; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="chart_div_problems"></div>
				</td>
			</tr>
		</table>
		<br/>
		<h2 style="font-weight: 100; position: relative; left: 10%;">Problem solved and time spend each month</h2>
		<table style="width: 80%; border: 0px solid #ccc;" border="0" align="center" cellspacing="20">
			<tr>
				<td style="width: 50%; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="chart_div"></div>
				</td>
				<td style="width: 50%; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="chart_div_line"></div>
				</td>
			</tr>
		</table>
		<h2 style="font-weight: 100; position: relative; left: 10%;">Interiew statistics</h2>
		<table style="width: 80%; border: 0px solid #ccc;" border="0" align="center" cellspacing="20">
			<tr>
				<td style="width: 50%; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="chart_div_interview_pie"></div>
				</td>
				<td style="width: 50%; padding: 20px; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="chart_div_interview_bar"></div>
				</td>
			</tr>
		</table>
		<br/>
		<h2 style="font-weight: 100; position: relative;left: 10%;">Lecture / Tutorial listening</h2>
		<table style="width: 80%; border: 0px solid #ccc;" border="0" align="center" cellspacing="20">
			<tr>
				<td style="width: 50%; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="chart_div_lecture_pie"></div>
				</td>
				<td style="width: 50%; border-radius: 8px; border: 1px solid #eee;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);">
				    <div id="chart_div_lecture_hours"></div>
				</td>
			</tr>
		</table>
		<?php
			} else {
				header('Location: index.php?error=Please signin / signup to the system');
				exit;
			}
		?>
		<br/>
		<center>Contact us at hello@preplogger.com</center>
	</body>
		<script type="text/javascript">
	      	google.load("visualization", "1", {packages:["corechart"]});
	      	google.setOnLoadCallback(drawChart);
	      	google.setOnLoadCallback(drawVisualization);
	      	google.setOnLoadCallback(drawVisualizationLine);
	      	google.setOnLoadCallback(drawVisualizationProblems);
	      	google.setOnLoadCallback(drawVisualizationInterview);
	      	google.setOnLoadCallback(drawVisualizationLecturePie);
	      	google.setOnLoadCallback(drawVisualizationInterviewPie);
	      	google.setOnLoadCallback(drawVisualizationLectureHours);

	      	function drawChart() {

	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatLevel.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
				        var data = google.visualization.arrayToDataTable([
				          	['Levels', 'Percentage'],
				          	['Attempted',     json[3]],
				          	['Hard',      json[2]],
				          	['Medium',  json[1]],
				          	['Easy', json[0]]
				        ]);

				        var options = {
				          	title: 'Total I have solved ' + String(json[2] + json[1] + json[0]) + ' problems',
				          	pieHole: 0,
				          	colors: ['#ccc', '#00796b', '#26a69a', '#b2dfdb'],
				          	width:600,
			              	height:450
				        };

			        	var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			        	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationLecturePie() {

	      		var xhr = new XMLHttpRequest();
				var url = "getLectureStat.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Lecture");
				        console.log(json);

				        var data=[];
						var Header= ['Topic', 'Percentage'];
						data.push(Header);
						for (var i = 0; i < json.length; i += 2) {
						    var temp=[];
						    temp.push(json[i]);
						    temp.push(parseFloat(json[i + 1]));

						    data.push(temp);
						}
						
						var chartdata = google.visualization.arrayToDataTable(data);
				     
				        console.log(data);

			        	var options = {
				          	title: 'Lecture / Tutorial Topics',
				          	pieHole: 0.4,
				          	colors: ['#b2dfdb', '#80cbc4', '#4db6ac', '#26a69a', '#009688', 
				          	'#00897b', '#00796b', '#00695c', '#004d40'],
				          	width:600,
			              	height:450
				        };

			        	var chart = new google.visualization.PieChart(document.getElementById('chart_div_lecture_pie'));
			        	chart.draw(chartdata, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationInterviewPie() {

	      		var xhr = new XMLHttpRequest();
				var url = "getInterviewStatTopics.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Interview topics");
				        console.log(json);

				        var data=[];
						var Header= ['Topic', 'Percentage'];
						data.push(Header);
						for (var i = 0; i < json.length; i += 2) {
						    var temp=[];
						    temp.push(json[i]);
						    temp.push(parseFloat(json[i + 1]));

						    data.push(temp);
						}
						
						var chartdata = google.visualization.arrayToDataTable(data);
				     
				        console.log(data);

			        	var options = {
				          	title: 'Topics Covered in Interview',
				          	pieHole: 0.4,
				          	colors: ['#b2dfdb', '#80cbc4', '#4db6ac', '#26a69a', '#009688', 
				          	'#00897b', '#00796b', '#00695c', '#004d40'],
				          	width:600,
			              	height:450
				        };

			        	var chart = new google.visualization.PieChart(document.getElementById('chart_div_interview_pie'));
			        	chart.draw(chartdata, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationLectureHours() {

	      		var xhr = new XMLHttpRequest();
				var url = "getLectureStatHours.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
				        var s = 0;
				        for (var i = 0; i < 12; i++) {
				        	s += json[i] / 60;
				        }
			        	var data = google.visualization.arrayToDataTable([
			          		['Month', 'Spend hours'],
			          		['Jan',  json[0] / 60],
			          		['Feb',  json[1] / 60],
			          		['Mar',  json[2] / 60],
			          		['Apr',  json[3] / 60],
			          		['May',  json[4] / 60],
			          		['Jun',  json[5] / 60],
			          		['Jul',  json[6] / 60],
			          		['Aug',  json[7] / 60],
			          		['Sep',  json[8] / 60],
			          		['Oct',  json[9] / 60],
			          		['Nov',  json[10] / 60],
			          		['Dec',  json[11] / 60]
			        	]);

			        	var options = {
			          		title : 'How many hours I spend to listen lectures in each month (total ' + s.toFixed(2) + ' hours)',
			          		vAxis: {title: ''},
			          		hAxis: {title: 'Month'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#4db6ac'],       
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_lecture_hours'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationInterview() {

	      		var xhr = new XMLHttpRequest();
				var url = "getInterviewStat.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Interview");
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Steps', 'Percentage'],
			          		['Correct Idead',  json[0]],
			          		['Implemented',  json[1]],
			          		['Passed All tests',  json[2]]
			        	]);

			        	var options = {
			          		title : 'Performance in interview',
			          		vAxis: {title: ''},
			          		hAxis: {title: 'Steps'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#4db6ac'],       
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_interview_bar'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualization() {

	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatCount.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
				        var s = 0, p = 0;
				        for (var i = 0; i < 12; i++) {
				        	s += json[2 * i] / 60;
				        	p += json[2 * i + 1];
				        }
			        	var data = google.visualization.arrayToDataTable([
			          		['Month', 'Spend hours', 'Solved Problems'],
			          		['Jan',  json[0] / 60, json[1]],
			          		['Feb',  json[2] / 60, json[3]],
			          		['Mar',  json[4] / 60, json[5]],
			          		['Apr',  json[6] / 60, json[7]],
			          		['May',  json[8] / 60, json[9]],
			          		['Jun',  json[10] / 60, json[11]],
			          		['Jul',  json[12] / 60, json[13]],
			          		['Aug',  json[14] / 60, json[15]],
			          		['Sep',  json[16] / 60, json[17]],
			          		['Oct',  json[18] / 60, json[19]],
			          		['Nov',  json[20] / 60, json[21]],
			          		['Dec',  json[22] / 60, json[23]]
			        	]);

			        	var options = {
			          		title : 'Hours that I spend in each month (total ' + s + ' hours) \n Number of problems that I solved in each month (total ' + p + ' problems are solved)',
			          		vAxis: {title: ''},
			          		hAxis: {title: 'Month'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#64d8cb', '#009688'],     
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	        	
	      	}

	      	function drawVisualizationProblems() {
	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatSpeed.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Problem Level', 'Time to find a solution', 'Time to implement'],
			          		['Easy',  json[0], json[1]],
			          		['Medium',  json[2], json[3]],
			          		['Hard',  json[4], json[5]]
			        	]);

			        	var options = {
			          		title : 'How fast I solve easy / medium / hard problems? How many minutes I spend to think and implement?',
			          		vAxis: {title: 'minutes'},
			          		hAxis: {title: 'Problem Levels'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#64d8cb', '#009688'],   
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_problems'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	        	
	      	}

	      	function drawVisualizationLine() {

	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatHourCount.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Strange");
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Month', 'number of problems that solved in one hour'],
			          		['Jan',  json[0]],
			          		['Feb',  json[1]],
			          		['Mar',  json[2]],
			          		['Apr',  json[3]],
			          		['May',  json[4]],
			          		['Jun',  json[5]],
			          		['Jul',  json[6]],
			          		['Aug',  json[7]],
			          		['Sep',  json[8]],
			          		['Oct',  json[9]],
			          		['Nov',  json[10]],
			          		['Dec',  json[11]]
			        	]);

			        	var options = {
			          		title : 'How many problems I solve in one hour?',
			          		vAxis: {title: 'Minutes'},
			          		hAxis: {title: 'Levels'},
			          		seriesType: 'line',
			          		width:600,
		              		height:450,
		              		colors: ['#4db6ac'],    
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_line'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	    </script>
</html>