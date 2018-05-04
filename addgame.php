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
	$hScore = $_POST['hScore'];
	$aScore = $_POST['aScore'];
	$mvp = $_POST['mvp'];

	//This query inserts a new row into Game using values passed by a PHP file
	echo $query = "INSERT INTO Game(homeName,awayName,date,mvp,homeScore,awayScore) Values(\"".$_POST['hName']."\",\"".$_POST['aName']."\",\"".$_POST['date']."\",\"".$mvp."\",\"".$hScore."\",\"".$aScore."\");";

	//If the new Game has not happened yet, the score and MVP are set to NULL
	if($_POST['date'] > date("Y-m-d")) {
		echo $query = "INSERT INTO Game(homeName,awayName,date,mvp,homeScore,awayScore) Values(\"".$_POST['hName']."\",\"".$_POST['aName']."\",\"".$_POST['date']."\", NULL, NULL, NULL);";
	}

	//execute the query on the database
	$conn->query($query);

	$conn->close();
	header("Location: schedule.php");
?>