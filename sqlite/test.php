<?php
// http://localhost/sql-test/sqlite/test.php

require_once "db/DataSource.php";

use db\DataSource;


// ==========================
// SQLite接続
// ==========================

$db = new DataSource(
    __DIR__ . "/database.sqlite"
);


// ==========================
// テーブル作成
// ==========================

$sql = "
CREATE TABLE IF NOT EXISTS users (
    id TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
)
";

$db->execute($sql);
$sql = "
CREATE TABLE IF NOT EXISTS user_logs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id TEXT NOT NULL,
    action TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)
";

$db->execute($sql);


// ==========================
// データ追加
// ==========================

$id = bin2hex(random_bytes(16));

$sql = "
INSERT INTO users (
    id,
    name,
    email
)
VALUES (
    :id,
    :name,
    :email
)
";


$db->execute($sql, [
    ':id' => $id,
    ':name' => 'テストユーザー',
    ':email' => 'test@example.com'
]);


// ==========================
// データ表示
// ==========================

$users = $db->select(
    "SELECT * FROM users"
);


echo "<pre>";
print_r($users);
echo "</pre>";
