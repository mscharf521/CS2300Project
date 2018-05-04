<?php
	$servername = "localhost";
	$username = "root";
	//$password = "password";
	$dbname = "CS2300ProjectDB";

	// Create connection
	$conn = new mysqli($servername, $username, '', $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	//This query adds a new player to the database according to the inputed information
	echo $query = "INSERT INTO Player(lastName,firstName,number,goals,assists,status) Values(\"".$_POST['lName']."\",\"".$_POST['fName']."\",\"".$_POST['number']."\",\"".$_POST['goals']."\",\"".$_POST['assists']."\",\"".$_POST['status']."\");";
	//This query adds the players position to the database
	echo $query2 = "INSERT INTO Player2(lastName,number,position) Values(\"".$_POST['lName']."\",\"".$_POST['number']."\",\"".$_POST['position']."\");";

	$conn->query($query);
	$conn->query($query2);

	$conn->close();
	header("Location: roster.php");
?>