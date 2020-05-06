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

		$sql = "SELECT * FROM problems WHERE user_id = " . $_SESSION['id'];
		$result = $conn->query($sql);

		$cntEasy = 0;
		$cntMedium = 0;
		$cntHard = 0;
		$cntAttempted = 0;

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	if (($row["status"] == "Solved" || $row["status"] == "Solved with hints") && $row["problem_level"] == "Easy") {
		    		$cntEasy++;
		    	}
		    	if (($row["status"] == "Solved" || $row["status"] == "Solved with hints") && $row["problem_level"] == "Medium") {
		    		$cntMedium++;
		    	}
		    	if (($row["status"] == "Solved" || $row["status"] == "Solved with hints") && $row["problem_level"] == "Hard") {
		    		$cntHard++;
		    	}
		    	if ($row["status"] == "Not solved") {
		    		$cntAttempted++;
		    	}
		    }
		}
		$conn->close();
		$cnt = array();
		array_push($cnt, $cntEasy);
		array_push($cnt, $cntMedium);
		array_push($cnt, $cntHard);
		array_push($cnt, $cntAttempted);

		echo json_encode($cnt);
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>