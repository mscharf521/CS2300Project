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

			echo '<div id="staff" class="content-page">
				<h1 class="header">Staff</h1>
				<h2 id="table-title">Manager</h2>
				<table id="schedule-table">
					
					<tr>
						<th>Staff ID</th>
						<th>Name</th>
						<th>Salary</th>
						<th>Bonus</th>
					</tr>';

			//This query gets the staff member who is the manager
			$query = "SELECT * FROM staff S, manager G WHERE S.staffID = G.staffID;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				echo '<tr>';
				echo '<td>'.$arrayResult['staffID'].'</td>';
				echo '<td>'.$arrayResult['name'].'</td>';
				echo '<td>$'.$arrayResult['salary'].'</td>';
				echo '<td>$'.$arrayResult['bonus'].'</td>';
				echo '</tr>';
				
			}
					echo '
				</table>
				<h2 id="table-title">Trainers</h2>
				<table id="schedule-table">
					<tr>
						<th>Staff ID</th>
						<th>Name</th>
						<th>Salary</th>
						<th>Specialty</th>
					</tr>';

			//This query gets the staff members who are trainers
			$query = "SELECT * FROM staff S, trainer T WHERE S.staffID = T.staffID;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				echo '<tr>';
				echo '<td>'.$arrayResult['staffID'].'</td>';
				echo '<td>'.$arrayResult['name'].'</td>';
				echo '<td>$'.$arrayResult['salary'].'</td>';
				echo '<td>'.$arrayResult['specialty'].'</td>';
				echo '</tr>';
				
			}
					echo '
				</table>
				<h2 id="table-title">Vendors</h2>
				<table id="schedule-table">
					<tr>
						<th>Staff ID</th>
						<th>Name</th>
						<th>Salary</th>
						<th>Type</th>
					</tr>';

			//This query gets all the vendors who work for the club
			$query = "SELECT DISTINCT * FROM staff S, vendor V WHERE S.staffID = V.staffID;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				$staffID = $arrayResult['staffID'];
				echo '<tr>';
				echo '<td>'.$arrayResult['staffID'].'</td>';
				echo '<td>'.$arrayResult['name'].'</td>';
				echo '<td>$'.$arrayResult['salary'].'</td>';

				//This query checks if the staff member is a merchandise seller
				$queryM = "SELECT COUNT(*) FROM merchandiseseller M WHERE M.staffID = '$staffID'";
				$resultM = $conn->query($queryM);
				while ($arrayResult = $resultM->fetch_assoc()) {
					if ($arrayResult['COUNT(*)'] != 0) {
						echo '<td> Merchandise </td>';
					}
				}

				//This query checks if the staff member is a ticket seller
				$queryT = "SELECT COUNT(*) FROM ticketseller T WHERE T.staffID = '$staffID'";
				$resultT = $conn->query($queryT);
				while ($arrayResult = $resultT->fetch_assoc()) {
					if ($arrayResult['COUNT(*)'] != 0) {
						echo '<td> Ticket </td>';
					}
				}

				//This query checks if the staff member is a food seller
				$queryF = "SELECT COUNT(*) FROM foodseller F WHERE F.staffID = '$staffID'";
				$resultF = $conn->query($queryF);
				while ($arrayResult = $resultF->fetch_assoc()) {
					if ($arrayResult['COUNT(*)'] != 0) {
						echo '<td> Food </td>';
					}
				}

				echo '</tr>';
				
			}
					echo '
				</table>';

			$conn->close();
		?>
		</div>
	</body>
</html>