<?php
function getDatabase()
{
	$pdo = new PDO('sqlite:../data/names.db');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("CREATE TABLE IF NOT EXISTS users (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		name TEXT NOT NULL,
		luck INTEGER DEFAULT -1,
		created_at DATETIME DEFAULT CURRENT_TIMESTAMP
	)");

	return $pdo;
}

function postName($name)
{
	$pdo = getDatabase();
	$luck = random_int(0, 100);
	$stmt = $pdo->prepare("INSERT INTO users (name, luck) VALUES (?, ?)");
	return $stmt->execute([$name, $luck]);
}

function getLuckiestUser()
{
	$pdo = getDatabase();
	$stmt = $pdo->query("SELECT name, luck FROM users ORDER BY luck DESC LIMIT 1");
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAverageLuck()
{
	$pdo = getDatabase();
	$stmt = $pdo->query("SELECT AVG(luck) AS average_luck FROM users");
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result ? $result['average_luck'] : null;
}
