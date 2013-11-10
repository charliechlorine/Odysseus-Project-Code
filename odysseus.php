<!DOCTYPE html>
	<head>
		<title>Real Time Odysseus</title>
		<link rel="stylesheet" type="text/css" href="/stylesheets/odysseus.css">
		<link href="/pictures/favicon.ico" rel="icon" type="image/x-icon">
	</head>
	<body>
		<?php 

			$startdate = strtotime('2013-11-12');
			$timetoday = time();

			$daysgone = $timetoday - $startdate;
			$daysgone = $daysgone / 86400;

			//Drops Decimal Places
			$daysgone = floor($daysgone);

			//MySQL Connections
			$con = mysql_connect("localhost", "username", "password");
			$select = mysql_select_db("database", $con);

			//MySQL Select
			$sqlname = "SELECT * FROM `MyTable` WHERE $daysgone >= MinDay AND $daysgone <= MaxDay";
			$nameresp = mysql_query($sqlname);

			if ($daysgone < 0){

				$action = 'in';
				$place = 'Troy';
				$description = 'Odysseus has used his wits to defeat ';
				$description .= 'the Trojans and win back Helen of Sparta. ';
				$description .= 'He starts his journey back home on November 12th.';

			} elseif ($daysgone > 3644) {

				$action = 'back in';
				$place = 'Ithaca';
				$description = 'Odysseus is back in control of the kingdom. ';
				$description .= 'The suitors are dead, and the perils of the past behind them. '; 
				$description .= 'The moral of the story still stands ';
				$description .= '"if at first you can\'t succeed, try, try again".';

			} else {

				while($row = mysql_fetch_array($nameresp)){

					$action = $row['Prefix'];
					$place = $row['Place'];
					$description = $row['Description'];

				}
			}

		?>
		<div class="center">
			<img src="/pictures/mainpic.png" id="headerpic">

			<h1 id="location">Odysseus is <?php echo "$action  $place.";?></h1>

			<div id="colordiv">

				<p id="description"><?php echo "$description"; ?></p>

			</div>

			<p id="daysgone">Odysseus has been gone for: <?php $daysgone = $daysgone+3642; echo "$daysgone"; ?> Days</p>

			<a id="aboutlink" href="./about">About</a>

		</div>
	</body>
</html>