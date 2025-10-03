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
				<div style='margin-left: 2rem;'>

					<form method="POST" action="">
						<label>Please enter your name to get your daily luck:<br>
							<input type="text" name="name" maxlength="20" placeholder="Enter your name" required />
						</label>
						<button type="submit">Submit</button>
					</form>
					<?php
					if ($_POST['name'] ?? false) {
						echo "Welcome, " . $_POST['name'] . "!";
						postName($_POST['name']);
					}
					?>
				</div>
				<h1>Today's luckiest name</h1>
				<div style='margin-left: 2rem;'>

					<?php
					$luckiest = getLuckiestUser();
					if ($luckiest) {
						echo "<p style='margin-bottom: 0;'>It's...</p>";
						echo "<h1 class='lucky-name'>" . $luckiest['name'] . "!</h1>";
						echo "<p style='margin-top: 0;'>With " . $luckiest['luck'] . " luck!</p>";
					} else {
						echo "<p>No lucky names today yet - you could be the first!</p>";
					}
					?>
					<?php
					$averageLuck = getAverageLuck();
					if ($averageLuck) {
						echo "<p>Average luck today is " . round($averageLuck) . ".</p>";
					}
					?>
				</div>
			</div>
			<div class="past-winners">
				<h1>Recent daily luckiest names</h1>
				<div style='margin-left: 2rem;'>
					<p style='margin-bottom: 0;'>
						On Monday, date, it was...
					</p>
					<h1 class='lucky-name'>
						Harold
					</h1>
					<p style='margin-top: 0;'>
						With (x) luck!
					</p>
					<p style='margin-bottom: 0;'>
						On Monday, date, it was...
					</p>
					<h1 class='lucky-name'>
						Harold
					</h1>
					<p style='margin-top: 0;'>
						With (x) luck!
					</p>
					<p style='margin-bottom: 0;'>
						On Monday, date, it was...
					</p>
					<h1 class='lucky-name'>
						Harold
					</h1>
					<p style='margin-top: 0;'>
						With (x) luck!
					</p>
					<p style='margin-bottom: 0;'>
						On Monday, date, it was...
					</p>
					<h1 class='lucky-name'>
						Harold
					</h1>
					<p style='margin-top: 0;'>
						With (x) luck!
					</p>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

</html>