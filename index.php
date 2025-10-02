<?php
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<form method="POST" action="">
		<label>Please enter your name to get your daily luck:
			<input type="text" name="name" required />
		</label>
		<button type="submit">Submit</button>
	</form>
	<?php
	if ($_POST['name'] ?? false) {
		echo "Welcome, " . $_POST['name'] . "!";
		postName($_POST['name']);
	}
	?>
	<h1>Luckiest person</h1>
	<?php
	$luckiest = getLuckiestUser();
	if ($luckiest) {
		echo "Luckiest person is " . $luckiest['name'] . " with a luck of " . $luckiest['luck'] . "!";
	} else {
		echo "No fortunes told yet - you could be the first!";
	}
	?>
	<?php
	$averageLuck = getAverageLuck();
	if ($averageLuck) {
		echo "Average luck so far is " . round($averageLuck, 2) . ".";
	}
	?>
</body>

</html>