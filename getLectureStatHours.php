<?php
	session_start();

	if (isset($_SESSION['id'])) {

		header("Content-Type: application/json");

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

		$sql = "SELECT * FROM topic_session WHERE user_id = " . $_SESSION['id'];
		$result = $conn->query($sql);

		$timeCnt = array();
		$totalCnt = array();

		for ($i = 0; $i < 12; $i++) {
			array_push($timeCnt, 0);
			array_push($totalCnt, 0);
		}

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$temp = $row["learned_date"];
		    	$month = intval(explode("/", $temp)[1]);
		    	$month--;
		    	for ($i = 1; $i <= 12; $i++) {
					if ($month == $i) {
						$timeCnt[$i] += floatval($row["hours"]);
						$totalCnt[$i]++;
						break;
					}
				}
		    }
		}
		$conn->close();
		$cnt = array();
		for ($i = 0; $i < 12; $i++) {
			array_push($cnt, $timeCnt[$i]);
		}

		echo json_encode($cnt);
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>