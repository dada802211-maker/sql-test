<?php
$pdo = new PDO("sqlite:" . __DIR__ . "/../database.sqlite");

$id = "84334274880152688ae72efafd249ca0";

$stmt = $pdo->prepare("
    SELECT id, name, email
    FROM users
    WHERE id = :id
");

$stmt->execute([':id' => $id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user ?: ['message' => 'not found'], JSON_UNESCAPED_UNICODE);

// http://localhost/sql-test/sqlite-select-one/
