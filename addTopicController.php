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

		$sql = "INSERT INTO topics (user_id, topic_name) VALUES ('" . $_SESSION['id'] . "', '" . $temp['table'][0]['topicName'] . "')";

		if ($conn->query($sql) === FALSE) {
		   
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

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
		
		echo "<table border='0' width='80%'' cellpadding='10' cellspacing='10' align='center'>";

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
		echo "</table>";
		$conn->close();
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>