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
	//This query deletes the player from the database accoriding to input
	echo $query = "DELETE FROM `player` WHERE `player`.`lastName` = \"".$_POST['lName']."\" AND `player`.`number` = \"".$_POST['number']."\";";
	//This query deletes the player from the database(position table) accoriding to input
	echo $query2 = "DELETE FROM `player2` WHERE `player2`.`lastName` = \"".$_POST['lName']."\" AND `player2`.`number` = \"".$_POST['number']."\";";

	$conn->query($query2);
	$conn->query($query);

	$conn->close();
	header("Location: roster.php");
?>