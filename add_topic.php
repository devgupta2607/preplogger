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
		<a style="font-weight: 100; position: relative; left: 10%; text-decoration: none; color: #777;" href="lecture.php">< go back</a>
		<br/>
		<br/>
		<div id="topic_area">
			<table border="0" width="80%" cellpadding="10" cellspacing="10" align="center">
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
					    	if ($i % $del == 0) {
					    		echo "<tr>";
					    	}
					    	echo "<td style='border: 1px solid #CCC; border-radius: 4px;-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
											-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
											box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);'>" . $row["topic_name"] . "</td>";
					    	if ($i % $del == $del - 1) {
					    		echo "</tr>";
					    	}
					        $i = $i + 1;
					    }
					}
					$conn->close();
				?>
			</table>
		</div>
		<br/>
		<center>
			<input type="text" placeholder="Type your topic name" style="width: 80%; padding: 15px; border-radius: 4px; border: 1px solid #CCC;" id="topicTxt" />
			<br/><br/>
			<button style="padding: 15px; width: 80%; border-radius: 4px; color: #555;
					background: #EEE; border: 1px solid #CCC;
					-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
					box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" onclick="addTopic()">Add the topic</button>
		</center>
		
		<?php
			} else {
				header('Location: index.php?error=Please signin / signup to the system');
				exit;
			}
		?>
	</body>
		<script type="text/javascript">
	    
			function addTopic() {
				var obj = {
				   table: []
				};

				var name = document.getElementById("topicTxt").value;

				if (name != "") {
					// console.log(level);
					// console.log(level);
					obj.table.push({topicName:name});
					var json = JSON.stringify(obj);
					console.log(json);

					var xhr = new XMLHttpRequest();
					var url = "addTopicController.php";
					xhr.open("POST", url, true);
					xhr.setRequestHeader("Content-Type", "application/json");
					xhr.onreadystatechange = function () {
					    if (xhr.readyState === 4 && xhr.status === 200) {
					        // var json = JSON.parse(xhr.responseText);
					        // console.log(json);
					        // console.log(xhr.responseText);
					        alert("Your topic is added to the interest list");
					        document.getElementById("topic_area").innerHTML = this.responseText;
					    }
					};
					var data = json;
					xhr.send(data);
					document.getElementById("topicTxt").value = "";
									} else {
					alert("Your topic name shouldn't be empty");
				}
			}

	    </script>
</html>