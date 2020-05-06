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

		$cntIdea = 0;
		$cntImplementation = 0;
		$cntPassedTests= 0;
		$counter = 0;

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$cntIdea += $row["idea"];
		    	$cntImplementation += $row["implementation"];
		    	$cntPassedTests += $row["passed_tests"];
		    	$counter++;
		    }
		}
		$conn->close();
		$cnt = array();
		if ($counter != 0) {
			array_push($cnt, $cntIdea / $counter);
			array_push($cnt, $cntImplementation / $counter);
			array_push($cnt, $cntPassedTests / $counter);
			array_push($cnt, $counter);
		} else {
			array_push($cnt, $counter);
			array_push($cnt, $counter);
			array_push($cnt, $counter);
			array_push($cnt, $counter);
		}

		echo json_encode($cnt);
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>