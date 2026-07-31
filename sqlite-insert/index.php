<?php
echo __DIR__;
$pdo = new PDO("sqlite:" . __DIR__ . "/../database.sqlite");

$id = bin2hex(random_bytes(16));
$name = "テストユーザー";
$email = "test@example.com";

$stmt = $pdo->prepare("
    INSERT INTO users (id, name, email)
    VALUES (:id, :name, :email)
");

$stmt->execute([
    ':id' => $id,
    ':name' => $name,
    ':email' => $email
]);

echo "作成成功: " . $id;

// http://localhost/sql-test/sqlite-insert/
