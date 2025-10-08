<?php
function getDatabase()
{
	$pdo = new PDO('sqlite:./data/names.db');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("CREATE TABLE IF NOT EXISTS users (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		name TEXT NOT NULL,
		luck INTEGER DEFAULT -1,
		created_at DATETIME DEFAULT CURRENT_TIMESTAMP
	)");

	return $pdo;
}

//returns luck
function postName($name)
{
	$pdo = getDatabase();
	$stmt = $pdo->prepare("SELECT name, luck FROM users WHERE name = ? AND date(created_at) = date('now')");
	$stmt->execute([$name]);
	$existingEntry = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($existingEntry) {
		return $existingEntry['luck'];
	}

	$luck = random_int(0, 100);
	$stmt = $pdo->prepare("INSERT INTO users (name, luck) VALUES (?, ?)");
	$stmt->execute([$name, $luck]);
	return $luck;
}

function getTodaysLuckiestUser()
{
	$pdo = getDatabase();
	$stmt = $pdo->query("SELECT name, luck FROM users WHERE date(created_at) = date('now') ORDER BY luck DESC LIMIT 1");
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTodaysAverageLuck()
{
	$pdo = getDatabase();
	$stmt = $pdo->query("SELECT AVG(luck) AS average_luck FROM users WHERE date(created_at) = date('now')");
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result ? $result['average_luck'] : null;
}

function getRecentLuckiestUsers()
{
	$pdo = getDatabase();
	$stmt = $pdo->query("SELECT name, MAX(luck) AS luck, date(created_at) AS date FROM users GROUP BY date(created_at) ORDER BY created_at DESC LIMIT 6");
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
