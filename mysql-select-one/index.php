<?php
$host = 'localhost';
$dbname = 'sql-test';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$id = "d4ff1616cc91547e03e797900ca54322";

$stmt = $pdo->prepare("
    SELECT id, name, email
    FROM users
    WHERE id = :id
");

$stmt->execute([':id' => $id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode($user, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['message' => 'データが見つかりません']);
}

// http://localhost/sql-test/mysql-select-one/
