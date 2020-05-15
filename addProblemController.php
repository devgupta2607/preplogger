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

		$sql = "INSERT INTO problems (user_id, problem_level, problem_tag, think_time, impl_time, status, solved_date) VALUES ('" . $_SESSION['id'] . "', '" . $temp['table'][0]['problemLevel'] . "', '" . $temp['table'][0]['problemTag'] . "', " . $temp['table'][0]['thinkTime'] . ", " . $temp['table'][0]['implTime'] . ", '" . $temp['table'][0]['problemStatus'] . "', '" . strval(date("Y/m/d")) . "')";

		if ($conn->query($sql) === FALSE) {
		   
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql = "SELECT * FROM problems WHERE user_id = " . $_SESSION['id'] . " AND solved_date = '" . strval(date("Y/m/d")) . "'";
		$result = $conn->query($sql);

		$cnt = 0;
		$time = 0;

		echo "<div id='solvedProblems'>";
		echo "<table style='width: 100%; border: 1px solid #ccc; border-top-left-radius: 8px; border-top-right-radius: 8px; -webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1); -moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);' cellpadding='10' border='0' cellspacing='0' align='center'>";
		echo "	<th>Problem level</th>";
		echo "	<th>Problem tag</th>";
		echo "	<th>Time to find a solution</th>";
		echo "	<th>Time to implement</th>";
		echo "	<th>Status</th>";
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
		echo "</table>";
		echo "<table align='right' cellspacing='10' cellpadding='10' style='position: relative;'>";
		echo "	<tr>";
		echo "		<td>";
		echo "			<p style='font-size: 2em; font-weight: 100;'><strong>" . number_format(($time / 60), 2) . "</strong> hour</p><p style='color: #999; position: relative; top: -2em;''>spend hours</p>";
		echo "		</td>";
		echo "		<td>";
		echo "			<p style='font-size: 2em; font-weight: 100;''><strong>" . $cnt . "</strong> problems</p><p style='color: #999; position: relative; top: -2em;'>solved problems</p>";
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";
		echo "</div>";
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>