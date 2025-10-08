<?php
require_once './src/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Name Fortunes</title>
	<link rel="icon" href="./favicon.png">
	<link rel="stylesheet" href="./index.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>

<body>
	<div class="container-parent">
		<div class="container">
			<div>
				<h1>How lucky is your name today?</h1>
				<div style='margin-left: 2rem;'>
					<form method="POST" action="">
						<label>Please enter your name to get your daily luck:<br>
							<input type="text" name="name" maxlength="20" placeholder="Enter your name" required />
						</label>
						<button type="submit">Submit</button>
					</form>
					<?php
					if ($_POST['name'] ?? false) {
						$name = htmlspecialchars($_POST['name']);
						$name = substr($name, 0, 20);
						$luck = postName($name);
						echo "<p>Hello, " . $name . "! Your luck today is <b>" . $luck . "</b>.</p>";
					}
					?>
				</div>
				<h1>Today's luckiest name</h1>
				<div style='margin-left: 2rem;'>
					<?php
					$luckiest = getTodaysLuckiestUser();
					if ($luckiest) {
						echo "<p style='margin-bottom: 0;'>It's...</p>";
						echo "<h1 class='lucky-name'>" . $luckiest['name'] . "!</h1>";
						echo "<p style='margin-top: 0;'>With <b>" . $luckiest['luck'] . "</b> luck!</p>";
					} else {
						echo "<p>No lucky names today yet - you could be the first!</p>";
					}
					?>
					<?php
					$averageLuck = getTodaysAverageLuck();
					if ($averageLuck) {
						echo "<p>Average luck today is <b>" . round($averageLuck) . "</b>.</p>";
					}
					?>
				</div>
			</div>
			<div class="past-winners">
				<h1>Recent daily luckiest names</h1>
				<div style='margin-left: 2rem;'>
					<?php
					$recentLuckiestUsers = getRecentLuckiestUsers();
					//Skip first entry, as it already gets displayed at Today's luckiest name
					$recentLuckiestUsers = array_slice($recentLuckiestUsers, 1);

					foreach ($recentLuckiestUsers as $luckyUser) {
						$date = new DateTime($luckyUser['date']);
						$formattedDate = $date->format('l, jS \o\f F Y');

						echo "<p style='margin-bottom: 0;'>";
						echo "On " . $formattedDate . " it was...";
						echo "</p>";
						echo "<h1 class='lucky-name'>";
						echo htmlspecialchars($luckyUser['name']);
						echo "</h1>";
						echo "<p style='margin-top: 0; margin-bottom: 2rem;'>";
						echo "With <b>" . $luckyUser['luck'] . "</b> luck!";
						echo "</p>";
					}
					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

</html>