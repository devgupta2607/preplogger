<?php

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

	$sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'";
	$result = $conn->query($sql);
	// echo $sql . "<br/>";
	// echo $result->num_rows;

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['id'] = $row['user_id'];
			header('Location: main.php');
			exit;
			// header('Location: temp.php');
			// exit;
		}
	}
	header('Location: index.php?error=Such user does not exist');
	exit;
?>