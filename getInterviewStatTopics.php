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

		$sql = "SELECT * FROM interview WHERE user_id = " . $_SESSION['id'];
		$result = $conn->query($sql);

		$cntEasy = 0;
		$cntMedium = 0;
		$cntHard = 0;
		$cntAttempted = 0;

		$topics = array();

		$topicName = array();
		$used = array();

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {

		    	array_push($topicName, $row["problem_tag"]);
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
						$cnt++;
					}
				}
				array_push($uniqueTopicName, $topicName[$i]);
		    	array_push($uniqueTopicHours, strval($cnt));
			}
		}

		if (count($uniqueTopicName) != 0) {
			for ($i = 0; $i < count($uniqueTopicName); $i++) {
				array_push($topics, $uniqueTopicName[$i]);
			    array_push($topics, $uniqueTopicHours[$i]);
			}
		} else {
			array_push($topics, "No topic");
		    array_push($topics, 100);
		}

		$conn->close();

		echo json_encode($topics);
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}
?>