<?php

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "preptracker";

	if ($_POST['password'] != $_POST['confirmPassword']) {
		header('Location: register.php?error=The passwords are do not match');
		exit;
	}

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
		header('Location: register.php?error=This user is already registered');
		exit;
	}

	$sql = "INSERT INTO users (username, password) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "')";

	if ($conn->query($sql) === FALSE) {
		   
		header('Location: register.php?error=Error while registration :(');
		exit;
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
	header('Location: index.php?error=Error while registration :(');
	exit;
?>