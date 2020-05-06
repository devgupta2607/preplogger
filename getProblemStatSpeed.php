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

		$timeThinkEasy = 0;
		$timeImplEasy = 0;
		$timeThinkMedium = 0;
		$timeImplMedium = 0;
		$timeThinkHard = 0;
		$timeImplHard = 0;

		$cntEasy = 0;
		$cntMedium = 0;
		$cntHard = 0;

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	if (($row["status"] == "Solved" || $row["status"] == "Solved with hints") && $row["problem_level"] == "Easy") {
		    		$cntEasy++;
		    		$timeThinkEasy += intval($row["think_time"]);
					$timeImplEasy += intval($row["impl_time"]);
		    	}
		    	if (($row["status"] == "Solved" || $row["status"] == "Solved with hints") && $row["problem_level"] == "Medium") {
		    		$cntMedium++;
		    		$timeThinkMedium += intval($row["think_time"]);
					$timeImplMedium += intval($row["impl_time"]);
		    	}
		    	if (($row["status"] == "Solved" || $row["status"] == "Solved with hints") && $row["problem_level"] == "Hard") {
		    		$cntHard++;
		    		$timeThinkHard += intval($row["think_time"]);
					$timeImplHard += intval($row["impl_time"]);
		    	}
		    	if ($row["status"] == "Not solved") {
		    		$cntAttempted++;
		    	}
		    }
		}
		$conn->close();
		$cnt = array();
		if ($cntEasy != 0) {
			array_push($cnt, round($timeThinkEasy / $cntEasy));
			array_push($cnt, round($timeImplEasy / $cntEasy));
		} else {
			array_push($cnt, 0);
			array_push($cnt, 0);
		}
		if ($cntMedium != 0) {
			array_push($cnt, round($timeThinkMedium / $cntMedium));
			array_push($cnt, round($timeImplMedium / $cntMedium));
		} else {
			array_push($cnt, 0);
			array_push($cnt, 0);
		}
		if ($cntHard != 0) {
			array_push($cnt, round($timeThinkHard / $cntHard));
			array_push($cnt, round($timeImplHard / $cntHard));
		} else {
			array_push($cnt, 0);
			array_push($cnt, 0);
		}
		

		echo json_encode($cnt);
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>