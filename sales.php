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
				<h1 class="header">Sales</h1>
				<h2 id="table-title">Vendor Sales</h2>
				<table id="schedule-table">
					<tr>
						<th>Staff ID</th>
						<th>Name</th>
						<th>Tickets Sold</th>
						<th>Ticket Sales</th>
					</tr>';

			//This query gets each of the ticket sellers and how many tickets they sold
			$query = "SELECT S.staffID, `name`, COUNT(*) FROM staff S, vendor V, ticketseller T, soldby B WHERE S.staffID = V.staffID AND V.staffID = T.staffID AND T.staffID = B.staffID GROUP BY `staffID`;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				$ID = $arrayResult['staffID'];
				echo '<tr>';
				echo '<td>'.$arrayResult['staffID'].'</td>';
				echo '<td>'.$arrayResult['name'].'</td>';
				echo '<td>'.$arrayResult['COUNT(*)'].'</td>';

				//This query sums the prices of the tickets sold by a single ticket seller
				$query2 = "SELECT SUM(price) FROM staff S, vendor V, ticketseller T, soldby B, ticket C WHERE S.staffID=$ID AND S.staffID = V.staffID AND V.staffID = T.staffID AND T.staffID = B.staffID AND B.seat = C.seat AND B.section = C.section  AND B.date = C.date GROUP BY S.staffID;";
				$result2 = $conn->query($query2);
				if ($result2 == FALSE)
					echo 'nope2';

				while ($arrayResult = $result2->fetch_assoc())
				{
					echo '<td>$ '.$arrayResult['SUM(price)'].'</td>';
					echo '</tr>';
				}
			}
			//This query gets the total amount of tickets sold by every ticket seller 
			$query = "SELECT COUNT(*) FROM staff S, vendor V, ticketseller T, soldby B WHERE S.staffID = V.staffID AND V.staffID = T.staffID AND T.staffID = B.staffID;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				echo '<tr>';
				echo '<td><b>TOTAL</b></td>';
				echo '<td></td>';
				echo '<td>'.$arrayResult['COUNT(*)'].'</td>';
				//This query sums the price of every ticket sold 
				$query2 = "SELECT SUM(price) FROM staff S, vendor V, ticketseller T, soldby B, ticket C WHERE S.staffID = V.staffID AND V.staffID = T.staffID AND T.staffID = B.staffID AND B.seat = C.seat AND B.section = C.section AND B.date = C.date ";
				$result2 = $conn->query($query2);
				if ($result2 == FALSE)
					echo 'nope2';

				while ($arrayResult = $result2->fetch_assoc())
				{
					echo '<td>$ '.$arrayResult['SUM(price)'].'</td>';
					echo '</tr>';
				}
			}

			
					echo '
				</table>
				<h2 id="table-title">Fans</h2>
				<table id="schedule-table">
					
					<tr>
						<th>Name</th>
						<th>Tickets Purchased</th>
						<th>Total Spent</th>
					</tr>';

			//This query gets the name, number of tickets purchased and total amount spent for each fan
			$query = "SELECT F.fname, F.lname, COUNT(DISTINCT F.date), SUM(price) FROM fan F, ticket T WHERE F.seat = T.seat AND F.section = T.section AND F.date = T.date GROUP BY F.fname, F.lname;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				$fName = $arrayResult['fname'];
				$lName = $arrayResult['lname'];
				echo '<tr>';
				echo "<td>$fName $lName</td>";
				echo '<td>'.$arrayResult['COUNT(DISTINCT F.date)'].'</td>';
				echo '<td>$ '.$arrayResult['SUM(price)'].'</td>';
				echo '</tr>';
				
			}
					echo '
				</table>
				<h2 id="table-title">Match Sales</h2>
				<table id="schedule-table">
					
					<tr>
						<th>Date</th>
						<th>Home Team</th>
						<th>Away Team</th>
						<th>Attendance</th>
						<th>Revenue</th>
					</tr>';

			//This query gets the names of the teams, number of tickets sold and total amount of revenue for each match
			$query = "SELECT M.date, M.homeName, M.awayName, COUNT(*), SUM(price) FROM game M, ticket T WHERE M.date = T.date GROUP BY M.date;";
			$result = $conn->query($query);
			if ($result == FALSE)
				echo 'nope';

			while ($arrayResult = $result->fetch_assoc())
			{
				$date = $arrayResult['date'];
				$hName = $arrayResult['homeName'];
				$aName = $arrayResult['awayName'];
				echo '<tr>';
				echo "<td>$date</td>";
				echo "<td>$hName</td>";
				echo "<td>$aName</td>";
				echo '<td>'.$arrayResult['COUNT(*)'].'</td>';
				echo '<td>$ '.$arrayResult['SUM(price)'].'</td>';
				echo '</tr>';
				
			}
			echo '
				</table>';
				

			$conn->close();
		?>
		
			
		</div>
	</body>
</html>