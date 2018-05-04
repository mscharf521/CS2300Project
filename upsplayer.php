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
	//This query updates a specific player's information in the database
	echo $query = "UPDATE `player` SET `goals` = '".$_POST['goals']."', `assists` = '".$_POST['assists']."', `status` = '".$_POST['status']."' WHERE `player`.`lastName` = '".$_POST['lName']."' AND `player`.`number` = '".$_POST['number']."';";

	$conn->query($query);

	$conn->close();
	header("Location: roster.php");
?>