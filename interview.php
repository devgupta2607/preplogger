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
				<td style="width: 20%;
							background: #00695c; 
							border-radius: 8px;">
					<center><a style="font-weight: 900; color: white; text-decoration: none;" href="interview.php">Interview</a></center>
				</td>
				<td style="width: 20%;">
					<center><a style="font-weight: 900; color: black; text-decoration: none;" href="lecture.php">Lecture listening</a></center>
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
		<div id="passedInterviews">
	
			<table style="width: 80%; border: 1px solid #ccc; border-top-left-radius: 8px; border-top-right-radius: 8px; 
							-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
							-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
							box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" cellpadding="10" border="0" cellspacing="0" align="center">
				<th>Problem tag</th>
				<th>Hours spend</th>
				<th>Correct solution / idea</th>
				<th>Implemented</th>
				<th>Passed all tests</th>
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

					$sql = "SELECT * FROM interview WHERE user_id = " . $_SESSION['id'];
					$result = $conn->query($sql);

					$cnt = 0;
					$time = 0;
					$performance = 0;

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	if ($row["passed_tests"] == "100") {
					    		echo "<tr style='background: #e0f7fa;'>";
					    	} else {
					    		echo "<tr style='background: #ffcdd2;'>";
					    	}
					    	$cnt++;
					    	$time += $row["hours"];
					    	$temp = 0;
					    	$temp += $row["idea"];
					    	$temp += $row["passed_tests"];
					    	$temp += $row["implementation"];
					    	$temp /= 3.0;
					    	$performance += $temp;
					    	echo "	<td>";
					    	echo "		<center><p>" . $row["problem_tag"] . "</p></center>";
					    	echo "	</td>";
					    	echo "	<td>";
					    	echo "		<center><p>" . $row["hours"] . " hour</p></center>";
					    	echo "	</td>";
					    	echo "	<td>";
					    	echo "		<center><p>" . $row["idea"] . "%</p></center>";
					    	echo "	</td>";
					    	echo "	<td>";
					    	echo "		<center><p>" . $row["implementation"] . "%</p></center>";
					    	echo "	</td>";
					    	echo "	<td>";
					    	echo "		<center><p>" . $row["passed_tests"] . "%</p></center>";
					    	echo "	</td>";
					    	echo "</tr>";
					    }
					}
					$conn->close();
				?>
			</table>
			<table align="right" cellspacing="10" cellpadding="10" style="position: relative; right: 10%;">
				<tr>
					<td><p style="font-size: 3em; font-weight: 100;"><strong><?php echo $time;?></strong></p><p style="color: #999; position: relative; top: -2.5em;">spend hours</p></td>
					<td><p style="font-size: 3em; font-weight: 100;"><strong><?php echo $cnt;?></strong></p><p style="color: #999; position: relative; top: -2.5em;">interviews</p></td>
					<?php
					      if ($cnt == 0) {
					?>
					      	<td><p style="font-size: 3em; font-weight: 100;"><strong>0%</strong></p><p style="color: #999; position: relative; top: -2.5em;">performance</p></td>
					<?php
					      } else {
					?>
					      	<td><p style="font-size: 3em; font-weight: 100;"><strong><?php echo number_format(($performance / $cnt), 1); ?>%</strong></p><p style="color: #999; position: relative; top: -2.5em;">performance</p></td>
					<?php
					      }
					?>
				</tr>
			</table>
		</div>
		<br/><br/>
		<table style="width: 80%; border-radius: 8px; /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#44a08d+0,093637+100 */
					background: #44a08d; /* Old browsers */
					background: -moz-linear-gradient(top,  #44a08d 0%, #093637 100%); /* FF3.6-15 */
					background: -webkit-linear-gradient(top,  #44a08d 0%,#093637 100%); /* Chrome10-25,Safari5.1-6 */
					background: linear-gradient(to bottom,  #44a08d 0%,#093637 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#44a08d', endColorstr='#093637',GradientType=0 ); /* IE6-9 */
					-webkit-box-shadow: 7px 7px 29px -2px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -2px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -2px rgba(170,170,170,1);" cellpadding="20" border="0" cellspacing="0" id="interviewAddition" align="center">
			<tr>
				<td valign="top">
		      		<div class="select" id="problemTagInt" style="pointer-events: auto;">
					  	<select name="slct" id="slctproblemTagInt" onchange="selectProblemTagInt()">
					    	<option selected disabled>Choose problem tag</option>
					    	<option value="Array">Array</option>
					    	<option value="Hash Table">Hash Table</option>
					    	<option value="Linked List">Linked List</option>
					    	<option value="Math">Math</option>
					    	<option value="Two pointers">Two pointers</option>
					    	<option value="String">String</option>
					    	<option value="Binary Search">Binary Search</option>
					    	<option value="Divide and Conquer">Divide and Conquer</option>
					    	<option value="Dynamic Programming">Dynamic Programming</option>
					    	<option value="Backtracking">Backtracking</option>
					    	<option value="Stack">Stack</option>
					    	<option value="Heap">Heap</option>
					    	<option value="Greedy">Greedy</option>
					    	<option value="Sort">Sort</option>
					    	<option value="Bit Manipulation">Bit Manipulation</option>
					    	<option value="Tree">Tree</option>
					    	<option value="Depth-first Search">Depth-first Search</option>
					    	<option value="Breadth-first Search">Breadth-first Search</option>
					    	<option value="Union Find">Union Find</option>
					    	<option value="Graph">Graph</option>
					    	<option value="Design">Design</option>
					    	<option value="Topological Sort">Topological Sort</option>
					    	<option value="Trie">Trie</option>
					    	<option value="Binary Indexed Tree">Binary Indexed Tree</option>
					    	<option value="Segment Tree">Segment Tree</option>
					    	<option value="Binary Search Tree">Binary Search Tree</option>
					    	<option value="Recursion">Recursion</option>
					    	<option value="Brainteaser">Brainteaser</option>
					    	<option value="Memorization">Memorization</option>
					    	<option value="Queue">Queue</option>
					    	<option value="Minimax">Minimax</option>
					    	<option value="Reservoir Sampling">Reservoir Sampling</option>
					    	<option value="Ordered Map">Ordered Map</option>
					    	<option value="Geometry">Geometry</option>
					    	<option value="Random">Random</option>
					    	<option value="Rejection Sampling">Rejection Sampling</option>
					    	<option value="Sliding Window">Sliding Window</option>
					    	<option value="Line Sweep">Line Sweep</option>
					    	<option value="Rolling Hash">Rolling Hash</option>
					    	<option value="Suffix Array">Suffix Array</option>
					  	</select>
					</div>
					<p style="font-weight: 900; color: #eee; " id="step1Int">Step 1 &#8594; </p>
				</td>
				<td valign="top">
				      <div class="select" id="hoursSpend" style="pointer-events: none;">
					  	<select name="slct" id="slcthoursSpend" onchange="selectHoursSpend()">
					    	<option selected disabled>Choose hours spend</option>
					    	<option value="0.1">0.1 hour</option>
					    	<option value="0.2">0.2 hour</option>
					    	<option value="0.3">0.3 hour</option>
					    	<option value="0.4">0.4 hour</option>
					    	<option value="0.5">0.5 hour</option>
					    	<option value="0.6">0.6 hour</option>
					    	<option value="0.7">0.7 hour</option>
					    	<option value="0.8">0.8 hour</option>
					    	<option value="0.9">0.9 hour</option>
					    	<option value="1">1 hour</option>
					  	</select>
					</div>
					<p style="font-weight: 900; color: #aaa; " id="step2Int">Step 2</p>
				</td>
				<td valign="top">
				      <div class="select" id="problemCorrectness" style="pointer-events: none;">
					  	<select name="slct" id="slctproblemCorrectness" onchange="selectProblemCorrectness()">
					    	<option selected disabled>Choose idea correctness %</option>
					    	<option value="0">0%</option>
					    	<option value="10">10%</option>
					    	<option value="20">20%</option>
					    	<option value="30">30%</option>
					    	<option value="40">40%</option>
					    	<option value="50">50%</option>
					    	<option value="60">60%</option>
					    	<option value="70">70%</option>
					    	<option value="80">80%</option>
					    	<option value="90">90%</option>
					    	<option value="100">100%</option>
					  	</select>
					</div>
					<p style="font-weight: 900; color: #aaa; " id="step3Int">Step 3</p>
				</td>
				<td valign="top">
				      <div class="select" id="problemImpl" style="pointer-events: none;">
					  	<select name="slct" id="slctImpl" onchange="selectImpl()">
					    	<option selected disabled>Choose implementation correctness</option>
					    	<option value="0">0%</option>
					    	<option value="10">10%</option>
					    	<option value="20">20%</option>
					    	<option value="30">30%</option>
					    	<option value="40">40%</option>
					    	<option value="50">50%</option>
					    	<option value="60">60%</option>
					    	<option value="70">70%</option>
					    	<option value="80">80%</option>
					    	<option value="90">90%</option>
					    	<option value="100">100%</option>
					  	</select>
					</div>
					<p style="font-weight: 900; color: #aaa; " id="step4Int">Step 4</p>
				</td>
				<td valign="top">
				      <div class="select" id="problemTestPassed" style="pointer-events: none;">
					  	<select name="slct" id="slctpassedTests" onchange="selectPassedTests()">
					    	<option selected disabled>Percentage of passed tests</option>
					    	<option value="0">0%</option>
					    	<option value="10">10%</option>
					    	<option value="20">20%</option>
					    	<option value="30">30%</option>
					    	<option value="40">40%</option>
					    	<option value="50">50%</option>
					    	<option value="60">60%</option>
					    	<option value="70">70%</option>
					    	<option value="80">80%</option>
					    	<option value="90">90%</option>
					    	<option value="100">100%</option>
					  	</select>
					</div>
					<p style="font-weight: 900; color: #aaa; " id="step5Int">Step 5</p>
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
			function selectProblemTagInt() {
				document.getElementById("hoursSpend").style="pointer-events:auto;";
				document.getElementById("step2Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectHoursSpend() {
				document.getElementById("slctproblemCorrectness").style="pointer-events:auto;";
				document.getElementById("step3Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectProblemCorrectness() {
				document.getElementById("problemImpl").style="pointer-events:auto;";
				document.getElementById("step4Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectImpl() {
				document.getElementById("problemTestPassed").style="pointer-events:auto;";
				document.getElementById("step5Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectPassedTests() {
				var obj = {
				   table: []
				};

				var eProblemTag = document.getElementById("slctproblemTagInt");
				var tag = eProblemTag.options[eProblemTag.selectedIndex].value;

				var eHoursSpend = document.getElementById("slcthoursSpend");
				var hours = eHoursSpend.options[eHoursSpend.selectedIndex].value;

				var eCorrectIdea = document.getElementById("slctproblemCorrectness");
				var idea = eCorrectIdea.options[eCorrectIdea.selectedIndex].value;

				var eImplementation = document.getElementById("slctImpl");
				var impl = eImplementation.options[eImplementation.selectedIndex].value;

				var ePassedTest = document.getElementById("slctpassedTests");
				var tests = ePassedTest.options[ePassedTest.selectedIndex].value;

				// console.log(level);
				// console.log(level);
				obj.table.push({problemTag:tag, hoursSpend: hours, ideaCorrectness: idea, implCorrectness: impl, passedTests: tests});
				var json = JSON.stringify(obj);
				console.log(json);

				var xhr = new XMLHttpRequest();
				var url = "addInterviewController.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        // var json = JSON.parse(xhr.responseText);
				        // console.log(json);
				        // console.log(xhr.responseText);
				        alert("Your interview details is added to the list");
				        document.getElementById("passedInterviews").innerHTML = this.responseText;
				        document.getElementById("interviewAddition").style.display ="none";
				    }
				};
				var data = json;
				xhr.send(data);
			}

	    </script>
</html>