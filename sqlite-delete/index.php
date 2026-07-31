<?php
$pdo = new PDO("sqlite:" . __DIR__ . "/../database.sqlite");

$id = "84334274880152688ae72efafd249ca0";

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute([':id' => $id]);

echo "削除件数: " . $stmt->rowCount();

// http://localhost/sql-test/sqlite-delete/
