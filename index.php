<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mainstyle.css">
		<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
		<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body>
		<div id="nav-bar">
			<div id="logo">
				<img src="img/man-logo.png"></img>
			</div>
			<div id="menu">
				<ul>
					<a href="index.php"><li id="home-but" class="menu-but">Home</li></a>
					<a href="schedule.php"><li id="schedule-but" class="menu-but">Schedule</li></a>
					<a href="roster.php"><li id="roster-but" class="menu-but">Roster</li></a>
					<a href="sales.php"><li id="sales-but" class="menu-but">Sales</li></a>
					<a href="staff.php"><li id="staff-but" class="menu-but">Staff</li></a>
				</ul>
			</div>
		</div>
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

			//This query is used to find the most recent game played by the club
			$query = "SELECT * FROM game ORDER BY `game`.`date` DESC;";
			$result = $conn->query($query);

			$prevGame = array();
			$foundPrev = FALSE;
			while ($arrayResult = $result->fetch_assoc())
			{	
				if (date("Y-m-d")>$arrayResult['date'] && !$foundPrev) {
					$prevGame[0] = $arrayResult['date'];
					$prevGame[1] = $arrayResult['homeName'];
					$prevGame[2] = $arrayResult['awayName'];
					$prevGame[3] = $arrayResult['homeScore'];
					$prevGame[4] = $arrayResult['awayScore'];

					$foundPrev = TRUE;
				}
			}

			//This query is used to find the next game on the club's schedule
			$query = "SELECT * FROM game ORDER BY `game`.`date` ASC;";
			$result = $conn->query($query);

			$nextGame = array();
			$foundPrev = FALSE;
			while ($arrayResult = $result->fetch_assoc())
			{	
				if (date("Y-m-d")<$arrayResult['date'] && !$foundPrev) {
					$nextGame[0] = $arrayResult['date'];
					$nextGame[1] = $arrayResult['homeName'];
					$nextGame[2] = $arrayResult['awayName'];

					$foundPrev = TRUE;
				}
			}
			echo '<div id="home" class="content-page">
					<div id="matches">
						<div id="match">
							<div id="match-header">
								<h2>Next Match</h2>
							</div>
							<div id="match-body">
								<h3>'.$nextGame[0].'</h3>
								<div id="match-match">
									<h3>'.$nextGame[1].'</h3>
									<h3>VS</h4>
									<h3>'.$nextGame[2].'</h3>
								</div>
								
							</div>
						</div>
						<div id="match">
							<div id="match-header">
								<h2>Previous Match</h2>
							</div>
							<div id="match-body">
								<h3>'.$prevGame[0].'</h3>
								<div id="match-score">
									<h1>'.$prevGame[3].' - '.$prevGame[4].'</h1>
								</div>
								<div id="match-match">
									<h3>'.$prevGame[1].'</h3>
									<h3>VS</h4>
									<h3>'.$prevGame[2].'</h3>
								</div>
								
							</div>
						</div>
					</div>
					<div id="highlight">
						<h2>Top Finishers</h2>
						<ol>';

			//This query is used to find the top 3 players with the highest amount of goals
			$query = "SELECT * FROM player ORDER BY `player`.`goals` DESC;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';
			$count = 0;
			while ($arrayResult = $result->fetch_assoc()) {
				if ($count < 3) {
					$fName = $arrayResult['firstName'];
					$lName = $arrayResult['lastName'];
					$goals = $arrayResult['goals'];
					echo "<li>$fName $lName - $goals Goals</li>";
					$count++;
				}
			}
						echo '</ol>
						<h2>Top Playmakers</h2>
						<ol>';

			//This query is used to find the top 3 players with the highest amount of assists
			$query = "SELECT * FROM player ORDER BY `player`.`assists` DESC;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';
			$count = 0;
			while ($arrayResult = $result->fetch_assoc()) {
				if ($count < 3) {
					$fName = $arrayResult['firstName'];
					$lName = $arrayResult['lastName'];
					$assists = $arrayResult['assists'];
					echo "<li>$fName $lName - $assists Assists</li>";
					$count++;
				}
			}
						echo '</ol>
						<h2>Team Stats</h2>
						<ul style="list-style-type: none; margin-left: -15px;">';

			//This query is finds the amount of games that have been played by the club already
			$query = "SELECT COUNT(*) FROM game G WHERE G.date < \"".date("Y-m-d")."\";";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc()) {
				$games = $arrayResult['COUNT(*)'];
				echo "<li>$games Games Played</li>";
			}
			
			//This query finds the average amount of assists and goals for the entire team
			$query = "SELECT AVG(goals), AVG(assists) FROM player;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc()) {
				$avgGoals = round($arrayResult['AVG(goals)'],1);
				$avgAssists = round($arrayResult['AVG(assists)'],1);
				echo "<li>$avgGoals Goals Per Game</li>";
				echo "<li>$avgAssists Assists Per Game</li>";
			}
						echo '</ul>
					</div>
				</div>';

			$conn->close();
		?>
		
	</body>
</html>