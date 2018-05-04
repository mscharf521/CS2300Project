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
	//This query deletes the inputed game from the database
	echo $query = "DELETE FROM `game` WHERE `game`.`homeName` = \"".$_POST['hName']."\" AND `game`.`awayName` = \"".$_POST['aName']."\" AND `game`.`date` = \"".$_POST['date']."\";";

	$conn->query($query2);
	$conn->query($query);

	$conn->close();
	header("Location: schedule.php");
?>