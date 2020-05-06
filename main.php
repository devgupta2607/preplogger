<html>
	<head>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    
	    <link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	<body style="background: #EEE;">
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
				<td style="width: 20%; 
				background: #00695c; 
				border-radius: 8px;">
					<center><a style="font-weight: 900; color: white; text-decoration: none;" href="main.php">Problem Solving</a></center>
				</td>
				<td style="width: 20%;">
					<center><a style="font-weight: 900; color: black; text-decoration: none;" href="interview.php">Interview</a></center>
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
		<p style="font-size: 2em; font-weight: 100; position: relative;left: 10%;">
		    <?php
		      	$monthNum = date("m");
		    ?>
		    <strong><?php echo date("d");?></strong> <?php echo date('F', mktime(0, 0, 0, $monthNum, 10)) . ", 20" . date("y");?>
		</p>
		<p style="font-size: 1em; font-weight: 100; position: relative;left: 10%; top: -15px; color: #777;">
		    Hello, <strong><?php echo $_SESSION['username'];?> </strong> &#128075; 
		</p>
		<br/>
		<!-- <p style="position: relative;left: 10%;">Hello Magzhan</p> -->
		<div id="solvedProblems">
			<table style="width: 80%; border: 1px solid #ccc; border-top-left-radius: 8px; border-top-right-radius: 8px; 
							-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
							-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
							box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" cellpadding="10" border="0" cellspacing="0" align="center">
			    <th>Problem level</th>
			    <th>Problem tag</th>
			    <th>Time to find a solution</th>
			    <th>Time to implement</th>
			    <th>Status</th>
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

					$sql = "SELECT * FROM problems WHERE user_id = " . $_SESSION['id'] . " AND solved_date = '" . strval(date("Y/m/d")) . "'";
					$result = $conn->query($sql);

					$cnt = 0;
					$time = 0;

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							if ($row["status"] == "Solved") {
								echo "<tr style='background: #e0f7fa;'>";
								$cnt++;
							} else if ($row["status"] == "Not solved") {
								echo "<tr style='background: #ffcdd2;'>";
							} else {
								echo "<tr style='background: #81b9bf;'>";
								$cnt++;
							}
							$time += intval($row["think_time"]);
							$time += intval($row["impl_time"]);
							echo "	<td>";
							echo "		<center><p>" . $row["problem_level"] . "</p></center>";
							echo "	</td>";
							echo "	<td>";
							echo "		<center><p>" . $row["problem_tag"] . "</p></center>";
							echo "	</td>";
							echo "	<td>";
							echo "		<center><p> ~" . $row["think_time"] . " min.</p></center>";
							echo "	</td>";
							echo "	<td>";
							echo "		<center><p> ~" . $row["impl_time"] . " min.</p></center>";
							echo "	</td>";
							echo "	<td>";
							echo "		<center><p>" . $row["status"] . "</p></center>";
							echo "	</td>";
							echo "</tr>";
						}
					}
					$conn->close();
				?>
			</table>
			<table align="right" cellspacing="10" cellpadding="10" style="position: relative; right: 10%;">
				<tr>
					<td>
					    <p style="font-size: 2em; font-weight: 100;"><strong><?php echo number_format(($time / 60), 2);?></strong> hour</p><p style="color: #999; position: relative; top: -2em;">spend hours</p>
					</td>
					<td>
					    <p style="font-size: 2em; font-weight: 100;"><strong><?php echo $cnt; ?></strong> problems</p><p style="color: #999; position: relative; top: -2em;">solved problems</p>
					</td>
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
					box-shadow: 7px 7px 29px -2px rgba(170,170,170,1);" cellpadding="20" border="0" cellspacing="10" id="problemAddition" align="center">
		    <tr>
		      	<td valign="top">
		      
		      		<span style="color: #FFF;">Problem level</span>
		      		<br/><br/>
		      		<div class="select" id="problemSelection">
			  			<select name="slct" id="slctProblemLvl" onchange="selectProblem()">
			    			<option selected disabled>Choose problem level</option>
			    			<option value="Easy">Easy</option>
			    			<option value="Medium">Medium</option>
			    			<option value="Hard">Hard</option>
			  			</select>
					</div>
					<p style="font-weight: 900; color: #EEEE;">Step 1 &#8594; </p>
		      	</td>
		      	<td valign="top">
		      		<span style="color: #FFF;">Problem tag</span>
		      		<br/><br/>
		      		<div class="select" id="problemTag" style="pointer-events: none;">
				  		<select name="slct" id="slctproblemTag" onchange="selectProblemTag()">
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
					<p style="font-weight: 900; color: #AAA; " id="step2">Step 2</p>
		    	</td>
		      	<td valign="top">
		      		<center style="color: #FFF;">Time to find a solution</center>
		      		<br/>
		      		<center id="thinkRecord" style="pointer-events: none;">
		      			<br/>
		      			<a class="button" id="thinkStart" style="background: #16a085; color: white;" onclick="startCounting()">Start</a>
		      			<!-- <a class="button" style="background: #e67e22; color: white;">Pause</a> -->
		      			<a class="button" style="background: #e74c3c; color: white;" onclick="stopThinking()" id="thinkStop">Stop</a>
		      			<br/>
		      			<p id="thinkingTime" style="font-size: 2em; color: white;"></p>
		      			<p id="thinkingTimeCopy" style="display: none;"></p>
				      	<div class="countup" id="countup1">
						  	<span class="timeel minutes">00</span>
						  	<span class="timeel timeRefMinutes">min</span>
						  	<span class="timeel seconds">00</span>
						  	<span class="timeel timeRefSeconds">sec</span>
						</div>
						<p style="font-weight: 900; color: #AAA;" id="step3">Step 3</p>
				    </center>
				</td>
		      	<td valign="top">
		      		<center style="color: #FFF;">Time to implement</center>
		      		<br/>
		      		<center id="implRecord" style="pointer-events: none;">
		      			<br/>
		      			<a class="button" id="implStart" style="background: #16a085; color: white;" onclick="startCountingImpl()">Start</a>
		      			<!-- <a class="button" style="background: #e67e22; color: white;">Pause</a> -->
		      			<a class="button" style="background: #e74c3c; color: white;" onclick="stopImpl()" id="implStop">Stop</a>
		      			<br/>
		      			<p id="implTime" style="font-size: 2em;"></p>
		      			<p id="implTimeCopy" style="display: none"></p>
				      	<div class="countup2" id="countup2">
						  	<span class="timeel minutes">00</span>
						  	<span class="timeel timeRefMinutes">min</span>
						  	<span class="timeel seconds">00</span>
						  	<span class="timeel timeRefSeconds">sec</span>
						</div>
				      	<p style="font-weight: 900; color: #AAA;" id="step4">Step 4</p>
		      		</center>
		      	</td>
		      	<td valign="top">
		      		<span style="color: #FFF;">Status</span>
		      		<br/><br/>
		      		<div class="select" id="selectStatus" style="pointer-events: none;">
					  	<select name="slct" id="slctStatus" onchange="addProblem()">
					    	<option selected disabled>Choose problem status</option>
					    	<option value="Solved">Solved</option>
					    	<option value="Not solved">Not solved</option>
					    	<option value="Solved with hints">Solved with hints</option>
					  	</select>
					</div>
					<p style="font-weight: 900; color: #AAA; " id="step5">Step 5.</p>
		      	</td>
		    </tr>
		</table>
		<br/>
		<br/>
		<!-- <p style="font-weight: 900; color: #777; display: none;" id="added">Problem is added</p> -->
		<!-- <hr style="border: 0px solid #CCC; border-bottom: 1px solid #DDD;"/> -->
		<p style="font-size: 1.3em; font-weight: 100; color: #000; position: relative;left: 10%;">
		    my history
		</p>
		<br/>
		<table style="width: 80%; border: 1px solid #ccc; border-top-left-radius: 8px; border-top-right-radius: 8px;
						border-top-left-radius: 8px; border-top-right-radius: 8px; 
						-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
						-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
						box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" cellpadding="10" border="0" cellspacing="0" align="center">
		    <th width="5%">#</th>
		    <th>Solved date</th>
			<th>Problem level</th>
			<th>Problem tag</th>
			<th>Time to find a solution</th>
			<th>Time to implement</th>
			<th>Status</th>
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

				$sql = "SELECT * FROM problems WHERE user_id = " . $_SESSION['id'] . " ORDER BY id DESC";
				$result = $conn->query($sql);

				$cnt = 0;
				$time = 0;

				if ($result->num_rows > 0) {
					$cnt = 0;
					// output data of each row
				    while($row = $result->fetch_assoc()) {
				    	if ($row["status"] == "Solved") {
				    		echo "<tr style='background: #e0f7fa;'>";
				    		$cnt++;
				    	} else if ($row["status"] == "Not solved") {
				    		echo "<tr style='background: #ffcdd2;'>";
					    } else {
					   		echo "<tr style='background: #81b9bf;'>";
					   		$cnt++;
					   	}
					   	$time += intval($row["think_time"]);
					  	$time += intval($row["impl_time"]);
					  	if ($row["status"] == "Solved") {
				    		echo "	<td>";
						   	echo "		<center><p>" . $cnt . "</p></center>";
						   	echo "	</td>";
				    	} else if ($row["status"] == "Solved with hints") {
				    		echo "	<td>";
						   	echo "		<center><p>" . $cnt . "</p></center>";
						   	echo "	</td>";
					    } else {
					    	echo "	<td>";
						   	echo "		<center><p></p></center>";
						   	echo "	</td>";
					    }
					  	echo "	<td>";
					   	echo "		<center><p>" . $row["solved_date"] . "</p></center>";
					   	echo "	</td>";
					    echo "	<td>";
					   	echo "		<center><p>" . $row["problem_level"] . "</p></center>";
					   	echo "	</td>";
					   	echo "	<td>";
					   	echo "		<center><p>" . $row["problem_tag"] . "</p></center>";
					   	echo "	</td>";
				    	echo "	<td>";
				    	echo "		<center><p> ~" . $row["think_time"] . " min.</p></center>";
				    	echo "	</td>";
				    	echo "	<td>";
				    	echo "		<center><p> ~" . $row["impl_time"] . " min.</p></center>";
				    	echo "	</td>";
				    	echo "	<td>";
				    	echo "		<center><p>" . $row["status"] . "</p></center>";
					    echo "	</td>";
					   	echo "</tr>";
					}
				} 
				$conn->close();
			?>
		</table>
		<?php
			} else {
				header('Location: index.php?error=Please signin / signup to the system');
				exit;
			}
		?>
	</body>
		<script type="text/javascript">
	      	var cntOne = 0, cntTwo = 0, cntThree = 0;
	      	function startCounting() {
	      		document.getElementById("thinkStart").style = "background: #AAAAAA;";
			  	// Month Day, Year Hour:Minute:Second, id-of-element-container
			  	if (cntOne == 0)
			  		countUpFromTime(new Date(), 'countup1'); // ****** Change this line!
			  	cntOne++;
			};
			function startCountingImpl() {
	      		document.getElementById("implStart").style = "background: #AAAAAA;";
			  	// Month Day, Year Hour:Minute:Second, id-of-element-container
			  	if (cntTwo == 0)
			  		countUpFromTime(new Date(), 'countup2'); // ****** Change this line!
			  	cntTwo++;
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
			function stopThinking() {
				var idEl = document.getElementById('countup1');
				document.getElementById('thinkingTime').innerHTML = idEl.getElementsByClassName('minutes')[0].innerHTML + ":" + idEl.getElementsByClassName('seconds')[0].innerHTML + " minutes";
				document.getElementById('thinkingTimeCopy').innerHTML = parseInt(idEl.getElementsByClassName('minutes')[0].innerHTML) * 60 + parseInt(idEl.getElementsByClassName('seconds')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('minutes')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('seconds')[0].innerHTML);
				document.getElementById('countup1').style.display = "none";
				document.getElementById("thinkStop").style.display = "none";
				document.getElementById("thinkStart").style.display = "none";
				document.getElementById('thinkingTime').style = "position: relative; top: -45px; font-size: 1.5em; color: white;";

				document.getElementById("implRecord").style="pointer-events:auto;";
				document.getElementById("step4").style = "font-weight: 900; color: #EEE; ";
				document.getElementById("step3").style = "font-weight: 900; color: #EEE; position: relative; top: -50px; ";
			}
			
			function stopImpl() {
				var idEl = document.getElementById('countup2');
				document.getElementById('implTime').innerHTML = idEl.getElementsByClassName('minutes')[0].innerHTML + ":" + idEl.getElementsByClassName('seconds')[0].innerHTML + " minutes";
				document.getElementById('implTimeCopy').innerHTML = parseInt(idEl.getElementsByClassName('minutes')[0].innerHTML) * 60 + parseInt(idEl.getElementsByClassName('seconds')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('minutes')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('seconds')[0].innerHTML);
				document.getElementById('countup2').style.display = "none";
				document.getElementById("implStop").style.display = "none";
				document.getElementById("implStart").style.display = "none";
				document.getElementById('implTime').style = "position: relative; top: -45px; font-size: 1.5em; color: white;";

				document.getElementById("selectStatus").style="pointer-events:auto;";
				document.getElementById("step5").style = "font-weight: 900; color: #EEE; ";
				document.getElementById("step4").style = "font-weight: 900; color: #EEE; position: relative; top: -50px; ";
			}

			function addProblem() {
				
				var obj = {
				   table: []
				};
				var eProblemLvl = document.getElementById("slctProblemLvl");
				var level = eProblemLvl.options[eProblemLvl.selectedIndex].value;

				var eProblemTag = document.getElementById("slctproblemTag");
				var tag = eProblemTag.options[eProblemTag.selectedIndex].value;

				var ttime = Math.floor(parseInt(document.getElementById("thinkingTimeCopy").innerHTML) / 60.0);
				var itime = Math.floor(parseInt(document.getElementById("implTimeCopy").innerHTML) / 60.0);

				var eProblemStatus = document.getElementById("slctStatus");
				var pstatus = eProblemStatus.options[eProblemStatus.selectedIndex].value;

				// console.log(level);
				// console.log(level);
				obj.table.push({problemLevel: level, problemTag:tag, thinkTime: ttime, implTime: itime, problemStatus: pstatus});
				var json = JSON.stringify(obj);
				console.log(json);

				var xhr = new XMLHttpRequest();
				var url = "addProblemController.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        // var json = JSON.parse(xhr.responseText);
				        // console.log(json);
				        // console.log(xhr.responseText);
				        alert("Your problem is added to the list");
				        document.getElementById("solvedProblems").innerHTML = this.responseText;
				        document.getElementById("problemTag").style="pointer-events:none;";
						// document.getElementById("thinkRecord").style="pointer-events:none;";
						// document.getElementById("hoursSpend").style="pointer-events:none;";
						// document.getElementById("slctproblemCorrectness").style="pointer-events:none;";
						// document.getElementById("problemImpl").style="pointer-events:none;";
						// document.getElementById("problemTestPassed").style="pointer-events:none;";
						document.getElementById("problemAddition").style.display ="none";
						// document.getElementById("slctStatus").style="pointer-events:none;";
						// document.getElementById("selectStatus").style.display = "none";
						// document.getElementById("added").style.display = "auto";
				    }
				};
				var data = json;
				xhr.send(data);
				
			}

			// document.getElementById("problemTag").style="pointer-events:none;";
			function selectProblem() {
				document.getElementById("problemTag").style="pointer-events:auto;";
				document.getElementById("step2").style = "font-weight: 900; color: #EEE; ";
			}
			function selectProblemTag() {
				document.getElementById("thinkRecord").style="pointer-events:auto;";
				document.getElementById("step3").style = "font-weight: 900; color: #EEE; ";
			}
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
	    </script>
</html>