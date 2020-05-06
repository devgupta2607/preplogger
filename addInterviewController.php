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

		$sql = "INSERT INTO `interview`(`user_id`, `problem_tag`, `hours`, `idea`, `implementation`, `passed_tests`, `interview_date`) VALUES ('" . $_SESSION['id'] . "', '" . $temp['table'][0]['problemTag'] . "', " . $temp['table'][0]['hoursSpend'] . ", " . $temp['table'][0]['ideaCorrectness'] . ", " . $temp['table'][0]['implCorrectness'] . ", " . $temp['table'][0]['passedTests'] . ", '" . strval(date("Y/m/d")) . "')";
		// INSERT INTO `interview`(`user_id`, `problem_tag`, `hours`, `idea`, `implementation`, `passed_tests`, `interview_date`) VALUES ('1','array',0.25,100,100,100,'3/05/2020')
		// INSERT INTO `interview`(`user_id`, `problem_tag`, `hours`, `idea`, `implementation`, `passed_tests`, `interview_date`) VALUES ('1','Array',0,25,100,100,100,'2020/05/03')

		if ($conn->query($sql) === FALSE) {
		   
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		echo "<table style='width: 80%; border: 1px solid #ccc; border-top-left-radius: 8px; border-top-right-radius: 8px; 
								-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
								-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
								box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);' cellpadding='10' border='0' cellspacing='0' align='center' >";
		echo "	<th>Problem tag</th>";
		echo "	<th>Hours spend</th>";
		echo "	<th>Correct solution / idea</th>";
		echo "	<th>Implemented</th>";
		echo "	<th>Passed all tests</th>";

		$sql = "SELECT * FROM interview WHERE user_id = " . $_SESSION['id'];
		$result = $conn->query($sql);

		$cnt = 0;
		$time = 0;
		$performance = 0;

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	if ($row["passed_tests"] == "100") {
		    echo "<tr style='background: #e0f7fa;'>";
		    	} else {
		    echo "<tr style='background: #ffcdd2;'>";
		    	}
		    	$cnt++;
		    	$time += $row["hours"];
		    	$temp = 0;
		    	$temp += $row["idea"];
		    	$temp += $row["passed_tests"];
		    	$temp += $row["implementation"];
		    	$temp /= 3.0;
		    	$performance += $temp;
		    	echo "	<td>";
		    	echo "<center><p>" . $row["problem_tag"] . "</p></center>";
		    	echo "	</td>";
		    	echo "	<td>";
		    	echo "<center><p>" . $row["hours"] . " hour</p></center>";
		    	echo "	</td>";
		    	echo "	<td>";
		    	echo "<center><p>" . $row["idea"] . "%</p></center>";
		    	echo "	</td>";
		    	echo "	<td>";
		    	echo "<center><p>" . $row["implementation"] . "%</p></center>";
		    	echo "	</td>";
		    	echo "	<td>";
		    	echo "<center><p>" . $row["passed_tests"] . "%</p></center>";
		    	echo "	</td>";
		    	echo "</tr>";
		    }
		} else {
		    echo "0 results";
		}
		$conn->close();

		echo "</table>";
		      	
		echo "<table align='right' cellspacing='10' cellpadding='10' style='position: relative; right: 10%;'>";
		echo "	<tr>";
		echo "		<td><p style='font-size: 3em; font-weight: 100;'><strong>" . $time . "</strong></p><p style='color: #999; position: relative; top: -2.5em;'>spend hours</p></td>";
		echo "			<td><p style='font-size: 3em; font-weight: 100;'><strong>" . $cnt . "</strong></p><p style='color: #999; position: relative; top: -2.5em;'>interviews</p></td>";
		if ($cnt == 0) {
			echo "		<td><p style='font-size: 3em; font-weight: 100;'><strong>0%</strong></p><p style='color: #999; position: relative; top: -2.5em;'>performance</p></td>";
		} else {
			echo "		<td><p style='font-size: 3em; font-weight: 100;'><strong>" . number_format(($performance / $cnt), 1) . "%</strong></p><p style='color: #999; position: relative; top: -2.5em;'>performance</p></td>";
		}
		echo "	</tr>";
		echo "</table>";
	} else {
		header('Location: index.php?error=Please signin / signup to the system');
		exit;
	}

?>