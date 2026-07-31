<?php
$pdo = new PDO("sqlite:" . __DIR__ . "/../database.sqlite");

$stmt = $pdo->query("SELECT id, name, email FROM users");

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($users, JSON_UNESCAPED_UNICODE);

// http://localhost/sql-test/sqlite-select/
