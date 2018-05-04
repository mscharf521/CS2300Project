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

			//echo "Connected successfully";

			echo '<div id=schedule class="content-page">
					<h1 class="header">Schedule</h1>
					<table id="schedule-table">
						<tr>
							<th>Date</th>
							<th>Home Team</th>
							<th>Away Team</th>
							<th>Score</th>
						</tr>';

			//This query gets all the games and orders them by their date
			$query = "SELECT * FROM game ORDER BY `game`.`date`;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				echo '<tr>';
				echo '<td>'.$arrayResult['date'].'</td>';
				echo '<td>'.$arrayResult['homeName'].'</td>';
				echo '<td>'.$arrayResult['awayName'].'</td>';
				if ($arrayResult['homeScore'] != NULL)
		        	echo '<td>'.$arrayResult['homeScore'].' - '.$arrayResult['awayScore'].'</td>';
		        else
		        	echo '<td> TBD </td>';
		        echo '</tr>';
			}

						echo '
					</table>
				</div>';


			$conn->close();
		?>
		<div id="roster-buttons">
				<div id="add-player-but" class="player-but">+ ADD GAME</div>
				<div id="del-player-but" class="player-but">- DELETE GAME</div>
				<div id="ups-player-but" class="player-but">UPDATE GAME STATS</div>
			</div>
			<div id="add-player-div" class="player-div">
				<form id="add-player-sub-div" action="addgame.php" method="post">
					<div>Home Name: <br/><input type="text" name="hName"></div>
					<div>Away Name: <br/><input type="text" name="aName"></div>
					<div>Date: <br/><input type="text" name="date"></div>
					<div>Home Goals: <br/><input type="text" name="hGoals"></div>
					<div>Away Goals: <br/><input type="text" name="aGoals"></div>
					<div>MVP: <br/><input type="text" name="mvp"></div>
					<input id="sub-but" type="submit">
				</form>
			</div>
			<div id="del-player-div" class="player-div">
				<form id="add-player-sub-div" action="delgame.php" method="post">
					<div>Home Name: <br/><input type="text" name="hName"></div>
					<div>Away Name: <br/><input type="text" name="aName"></div>
					<div>Date: <br/><input type="text" name="date"></div>
					<input id="sub-but" type="submit">
				</form>
			</div>
			<div id="ups-player-div" class="player-div">
				<form id="add-player-sub-div" action="upsgame.php" method="post">
					<div>Home Name: <br/><input type="text" name="hName"></div>
					<div>Away Name: <br/><input type="text" name="aName"></div>
					<div>Date: <br/><input type="text" name="date"></div>
					<div>Home Goals: <br/><input type="text" name="hGoals"></div>
					<div>Away Goals: <br/><input type="text" name="aGoals"></div>
					<div>MVP: <br/><input type="text" name="mvp"></div>
					<input id="sub-but" type="submit">
				</form>
			</div>
	</body>
</html>