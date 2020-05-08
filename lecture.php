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
				<td style="width: 20%; 
							background: #00695c; 
							border-radius: 8px;">
					<center><a style="font-weight: 900; color: white; text-decoration: none;" href="lecture.php">Lecture listening</a></center>
				</td>
				<td style="width: 20%;">
					<center><a style="font-weight: 900; color: black; text-decoration: none;" href="stat.php">Statistics</a></center>
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
		</p>
		<br/>
		<a style="font-weight: 100; position: relative; left: 10%; color: #777; text-decoration: none;" href="add_topic.php">add topics ></a>
		<br/>
		<br/>
		<div id="lecture_sessions">
			<table style="width: 80%; border: 1px solid #ccc; border-top-left-radius: 8px; border-top-right-radius: 8px; 
							-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
							-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
							box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" cellpadding="10" border="0" cellspacing="0" align="center">
				<th style="background: #EEE; border-top-left-radius: 8px;">Lecture / Topic area</th>
				<th style="background: #EEE; border-top-right-radius: 8px; ">Hours spend</th>
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

						$sql = "SELECT * FROM topic_session WHERE user_id = " . $_SESSION['id'] . " ORDER BY id DESC";
						$result = $conn->query($sql);
						$s = 0;

						if ($result->num_rows > 0) {
						    // output data of each row
						    while($row = $result->fetch_assoc()) {
						    	echo "<tr>";
						    	echo "<td style='width: 80%;'><center><p>" . $row["topic_name"] . "</p></center></td>";
						    	echo "<td><center><p>" . number_format(floatval($row["hours"]) / 60, 3) . "</p></center></td>";
						    	echo "</tr>";
						    	$s += floatval($row["hours"]);
						    }
						} 
						$conn->close();
					?>
			</table>
			<br/>
			<table align="right" style="position: relative; right: 10%; width: 80%;" border="0">
				<tr>
					<td>
						<div style="float: right;	">
							<p style="font-size: 2em; font-weight: 100;"><strong><?php echo number_format($s / 60, 3); ?></strong> hour</p>
							<p style="color: #999; position: relative; top: -2em;">spend hours</p>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<table style="width: 80%; border-radius: 8px; /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#44a08d+0,093637+100 */
					background: #44a08d; /* Old browsers */
					background: -moz-linear-gradient(top,  #44a08d 0%, #093637 100%); /* FF3.6-15 */
					background: -webkit-linear-gradient(top,  #44a08d 0%,#093637 100%); /* Chrome10-25,Safari5.1-6 */
					background: linear-gradient(to bottom,  #44a08d 0%,#093637 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#44a08d', endColorstr='#093637',GradientType=0 ); /* IE6-9 */
					-webkit-box-shadow: 7px 7px 29px -2px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -2px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -2px rgba(170,170,170,1); " cellpadding="20" border="0" cellspacing="0" id="lectureAddition" align="center">
			<tr>
				<td valign="top" width="80%">
		      		<span style="color: #EEE;">Topic</span>
		      		<br/><br/>
		      		<div class="select" id="lectureTxt" onchange="selectLectureTopic()">
			  			<select name="slct" id="slctTopicTxt">
			    			<option selected disabled>Choose topic</option>
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

								$sql = "SELECT * FROM topics WHERE user_id = " . $_SESSION['id'];
								$result = $conn->query($sql);

								$i = 0;

								if ($result->num_rows > 0) {
									$del = 4;
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								    	echo "<option value='" . $row["topic_name"] . "'>" . $row["topic_name"] . "</option>";
								    }
								}
								$conn->close();
							?>
			  			</select>
					</div>
					<p style="font-weight: 900; color: #EEEE;">Step 1 &#8594; </p>
				</td>
				<td valign="top">
				      <center style="color: #EEE;">Hours spend</center>
				      <br/>
				      <center id="lectureStartRecord" style="pointer-events: none;">
				      	<br/>
				      	<a class="button" id="lectureStart" style="background: #16a085; color: white;" onclick="startLectureCounting()">Start</a>
				      	<!-- <a class="button" style="background: #e67e22; color: white;">Pause</a> -->
				      	<a class="button" style="background: #e74c3c; color: white;" onclick="stopLecture()" id="lectureStop">Stop</a>
				      	<br/>
				      	<p id="lectureTime" style="font-size: 2em; color: white;"></p>
				      	<p id="lectureTimeCopy" style="display: none;"></p>
				      	<div class="countup" id="countup3">
						  	<span class="timeel minutes">00</span>
						  	<span class="timeel timeRefMinutes">min</span>
						  	<span class="timeel seconds">00</span>
						  	<span class="timeel timeRefSeconds">sec</span>
						</div>
						<p style="font-weight: 900; color: #AAA;" id="step2Lect">Step 2</p>
				      </center>
				</td>
			</tr>
		</table>
		<?php
			} else {
				header('Location: index.php?error=Please signin / signup to the system');
				exit;
			}
		?>
		<br/><br/><br/>
		<center>Contact us at hello@preplogger.com</center>
	</body>
		<script type="text/javascript">
	      	
	      	var cntOne = 0, cntTwo = 0, cntThree = 0;

			function startLectureCounting() {
	      		document.getElementById("lectureStart").style = "background: #AAAAAA;";
			  	// Month Day, Year Hour:Minute:Second, id-of-element-container
			  	if (cntThree == 0)
			  		countUpFromTime(new Date(), 'countup3'); // ****** Change this line!
			  	cntThree++;
			};

			function countUpFromTime(countFrom, id) {
			  	countFrom = new Date(countFrom).getTime();
			  	var now = new Date(),
			      	countFrom = new Date(countFrom),
			      	timeDifference = (now - countFrom);
			    
			  	var secondsInADay = 60 * 60 * 1000 * 24,
			      	secondsInAHour = 60 * 60 * 1000;
			    
			  	days = Math.floor(timeDifference / (secondsInADay) * 1);
			  	hours = Math.floor((timeDifference % (secondsInADay)) / (secondsInAHour) * 1);
			  	mins = Math.floor(((timeDifference % (secondsInADay)) % (secondsInAHour)) / (60 * 1000) * 1);
			  	secs = Math.floor((((timeDifference % (secondsInADay)) % (secondsInAHour)) % (60 * 1000)) / 1000 * 1);

			  	var idEl = document.getElementById(id);
			  	// idEl.getElementsByClassName('days')[0].innerHTML = days;
			  	// idEl.getElementsByClassName('hours')[0].innerHTML = hours;
			  	idEl.getElementsByClassName('minutes')[0].innerHTML = mins;
			  	idEl.getElementsByClassName('seconds')[0].innerHTML = secs;

			  	clearTimeout(countUpFromTime.interval);
			  	countUpFromTime.interval = setTimeout(function(){ countUpFromTime(countFrom, id); }, 1000);
			}

			function stopLecture() {
				var idEl = document.getElementById('countup3');
				document.getElementById('lectureTime').innerHTML = idEl.getElementsByClassName('minutes')[0].innerHTML + ":" + idEl.getElementsByClassName('seconds')[0].innerHTML + " minutes";
				document.getElementById('lectureTimeCopy').innerHTML = parseInt(idEl.getElementsByClassName('minutes')[0].innerHTML) * 60 + parseInt(idEl.getElementsByClassName('seconds')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('minutes')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('seconds')[0].innerHTML);
				document.getElementById('countup3').style.display = "none";
				document.getElementById("lectureStop").style.display = "none";
				document.getElementById("lectureStart").style.display = "none";
				document.getElementById('lectureTime').style = "position: relative; top: -45px; font-size: 1.5em; color: white;";

				var obj = {
				   table: []
				};

				var eTopicName = document.getElementById("slctTopicTxt");
				var name = eTopicName.options[eTopicName.selectedIndex].value;

				var hour = Math.floor(parseInt(document.getElementById("lectureTimeCopy").innerHTML) / 60.0);

				// console.log(level);
				// console.log(level);
				obj.table.push({topicName:name,topicHour:hour});
				var json = JSON.stringify(obj);
				console.log(json);

				var xhr = new XMLHttpRequest();
				var url = "addTopicSessionController.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        // var json = JSON.parse(xhr.responseText);
				        // console.log(json);
				        // console.log(xhr.responseText);
				        alert("Your topic is added to the interest list");
				        document.getElementById("lecture_sessions").innerHTML = this.responseText;
				        // console.log(this.responseText);
				        document.getElementById("lectureAddition").style.display ="none";
				    }
				};
				var data = json;
				xhr.send(data);
			}

			function selectLectureTopic() {
				document.getElementById("lectureStartRecord").style="pointer-events:auto;";
				document.getElementById("step2Lect").style = "font-weight: 900; color: #EEE; ";
			}

	    </script>
</html>