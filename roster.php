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

			echo '<div id="roster" class="content-page">
				<h1 class="header">Roster</h1>
				<form id="search-form" action="searchroster.php" method="post">
					<input id="search-bar" type="text" name="search" placeholder="Search Player Name...">
					<input id="search-sub-but" type="submit">
				</form>
				<table id="schedule-table">
					<tr>
						<th>Number</th>
						<th>Name</th>
						<th>Positions</th>
						<th>Goals</th>
						<th>Assists</th>
						<th>Status</th>
					</tr>';

			//This query gets all of the players in the club
			$query = "SELECT * FROM player;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				$fName = $arrayResult['firstName'];

				$lName = $arrayResult['lastName'];
				echo '<tr>';
				echo '<td>'.$arrayResult['number'].'</td>';
				echo "<td>$fName $lName</td>";

				$queryPos = "SELECT position 
							FROM player P,player2 Q 
							WHERE P.number = Q.number AND 
								Q.lastName = \"$lName\";";
				$result2 = $conn->query($queryPos);
				echo '<td>';
				$count = 0;
				while($arrayResult2 = $result2->fetch_assoc()) {
					if ($count != 0)
						echo ", ";
					echo $arrayResult2['position'];
					$count++;
				};
				echo '</td>';

				echo '<td>'.$arrayResult['goals'].'</td>';
		        echo '<td>'.$arrayResult['assists'].'</td>';
		        echo '<td>'.$arrayResult['status'].'</td>';
		        echo '</tr>';
			}
					echo '
				</table>';
				

			$conn->close();
		?>
		
			<div id="roster-buttons">
				<div id="add-player-but" class="player-but">+ ADD PLAYER</div>
				<div id="del-player-but" class="player-but">- DELETE PLAYER</div>
				<div id="ups-player-but" class="player-but">UPDATE PLAYER STATS</div>
			</div>
			<div id="add-player-div" class="player-div">
				<form id="add-player-sub-div" action="addplayer.php" method="post">
					<div>First Name: <input type="text" name="fName"></div>
					<div>Last Name: <input type="text" name="lName"></div>
					<div>Number: <input type="text" name="number"></div>
					<div>Goals: <input type="text" name="goals"></div>
					<div>Assists: <input type="text" name="assists"></div>
					<div>Status: <input type="text" name="status"></div>
					<div>Position: <input type="text" name="position"></div>
					<input id="sub-but" type="submit">
				</form>
			</div>
			<div id="del-player-div" class="player-div">
				<form id="add-player-sub-div" action="delplayer.php" method="post">
					<div>Last Name: <br/><input type="text" name="lName"></div>
					<div>Number: <br/><input type="text" name="number"></div>
					<input id="sub-but" type="submit">
				</form>
			</div>
			<div id="ups-player-div" class="player-div">
				<form id="add-player-sub-div" action="upsplayer.php" method="post">
					<div>Last Name: <br/><input type="text" name="lName"></div>
					<div>Number: <br/><input type="text" name="number"></div>
					<div>Goals: <br/><input type="text" name="goals"></div>
					<div>Assists: <br/><input type="text" name="assists"></div>
					<div>Status: <br/><input type="text" name="status"></div>
					<input id="sub-but" type="submit">
				</form>
			</div>
		</div>
	</body>
</html>