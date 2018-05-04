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
	//This query updates a specific game's information in the database
	echo $query = "UPDATE `game` SET `homeName` = '".$_POST['hName']."', `awayName` = '".$_POST['aName']."', `date` = '".$_POST['date']."', `mvp` = '".$_POST['mvp']."', `homeScore` = '".$_POST['hGoals']."', `awayScore` = '".$_POST['aGoals']."' WHERE `game`.`homeName` = '".$_POST['hName']."' AND `game`.`date` = '".$_POST['date']."' ;";

	$conn->query($query);

	$conn->close();
	header("Location: schedule.php");
?>