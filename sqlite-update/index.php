<?php
$pdo = new PDO("sqlite:" . __DIR__ . "/../database.sqlite");

$id = "84334274880152688ae72efafd249ca0";
$name = "更新後ユーザー";
$email = "updated@example.com";

$stmt = $pdo->prepare("
    UPDATE users
    SET name = :name,
        email = :email
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id,
    ':name' => $name,
    ':email' => $email
]);

echo "更新件数: " . $stmt->rowCount();

// http://localhost/sql-test/sqlite-update/
