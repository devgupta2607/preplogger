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

		$cntEasy = 0;
		$cntMedium = 0;
		$cntHard = 0;
		$cntAttempted = 0;

		$topics = array();

		$topicName = array();
		$topicHours = array();
		$used = array();

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {

		    	array_push($topicName, $row["topic_name"]);
		    	array_push($topicHours, floatval($row["hours"]));
		    	array_push($used, false);

		    	// array_push($topics, $row["topic_name"]);
		    	// array_push($topics, $row["hours"]);
		    }
		}


		$uniqueTopicName = array();
		$uniqueTopicHours = array();

		for ($i = 0; $i < count($topicName); $i++) {
			if ($used[$i] == false) {
				$cnt = 0;
				$used[$i] = true;
				for ($j = $i; $j < count($topicName); $j++) {
					if ($topicName[$i] == $topicName[$j]) {
						$used[$j] = true;
						$cnt += $topicHours[$j];
					}
				}
				array_push($uniqueTopicName, $topicName[$i]);
		    	array_push($uniqueTopicHours, strval($cnt));
			}
		}

		for ($i = 0; $i < count($uniqueTopicName); $i++) {
			array_push($topics, $uniqueTopicName[$i]);
		    array_push($topics, $uniqueTopicHours[$i]);
		}

		$conn->close();

		echo json_encode($topics);
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>