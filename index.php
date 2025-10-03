<?php
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lucky Names</title>
	<link rel="stylesheet" href="index.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>

<body>
	<div class="container-parent">
		<div class="container">
			<div>
				<h1>How lucky is your name today?</h1>
				<form method="POST" action="">
					<label>Please enter your name to get your daily luck:<br>
						<input type="text" name="name" placeholder="Enter your name" required />
					</label>
					<button type="submit">Submit</button>
				</form>
				<?php
				if ($_POST['name'] ?? false) {
					echo "Welcome, " . $_POST['name'] . "!";
					postName($_POST['name']);
				}
				?>
				<h1>Today's luckiest name</h1>
				<?php
				$luckiest = getLuckiestUser();
				if ($luckiest) {
					echo "<p>Luckiest today person is " . $luckiest['name'] .
						" with a luck of " . $luckiest['luck'] . "!</p>";
				} else {
					echo "<p>No fortunes told yet - you could be the first!</p>";
				}
				?>
				<?php
				$averageLuck = getAverageLuck();
				if ($averageLuck) {
					echo "<p>Average luck today is " . round($averageLuck, 2) . ".</p>";
				}
				?>
			</div>
			<div class="past-winners">
				<h1>Recent daily luckiest names</h1>
				<ul>
					<li>Monday - Harold</li>
					<li>Tuesday - Lindsey</li>
					<li>Monday - Harold</li>
					<li>Tuesday - Lindsey</li>
					<li>Monday - Harold</li>
				</ul>
			</div>
		</div>
	</div>
</body>

</html>

</html>