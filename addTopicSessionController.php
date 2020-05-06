<?php
	session_start();

	if (isset($_SESSION['id'])) {
		// $w = "{\"table\":[{\"problemLevel\":\"medium\",\"problemTag\":\"linked_list\",\"thinkTime\":\"1\",\"implTime\":\"1\",\"problemStatus\":\"not_solved\"}]}";
		header("Content-Type: application/json");
		// build a PHP variable from JSON sent using POST method
		$temp = json_decode(stripslashes(file_get_contents("php://input")), true);
		$u = json_encode($temp);
		// $temp = json_decode($w, true);
		// var_dump($temp);
		// var_dump($temp['table'][0]['problemLevel']);

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

		$sql = "INSERT INTO topic_session (topic_name, hours, user_id, learned_date) VALUES ('" . $temp['table'][0]['topicName'] . "', '" . $temp['table'][0]['topicHour'] . "', " . $_SESSION['id'] . ", '" . strval(date("Y/m/d")) . "')";

		if ($conn->query($sql) === FALSE) {
		   
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "preptracker";

		session_start();

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM topic_session WHERE user_id = " . $_SESSION['id'] . " ORDER BY id DESC";
		$result = $conn->query($sql);
		$s = 0;

		echo "<table style='width: 80%; border-collapse: collapse; border: 1px solid #ccc;  border-top-left-radius: 8px; border-top-right-radius: 8px; -webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1); -moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1); box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);' cellpadding='10' border='0' cellspacing='0' align='center'>";
		echo "<th style='background: #EEE; border-top-left-radius: 8px;'>Lecture / Topic area</th>";
		echo "<th style='background: #EEE; border-top-right-radius: 8px;'>Hours spend</th>";
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
		echo "<br/>";
		echo "<table align='right' style='position: relative; right: 10%; width: 80%;' border='0'>";
		echo "	<tr>";
		echo "		<td>";
		echo "			<div style='float: right;'>";
		echo "				<p style='font-size: 2em; font-weight: 100;'><strong>" . number_format($s / 60, 3) . "</strong> hour</p>";
		echo "				<p style='color: #999; position: relative; top: -2em;'>spend hours</p>";
		echo "			</div>";
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";
		$conn->close();
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>