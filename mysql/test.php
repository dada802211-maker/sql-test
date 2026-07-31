<?php
// http://localhost/sql-test/mysql/test.php

require_once "db/DataSource.php";

use db\DataSource;

$db = new DataSource(
    'localhost',
    '3306',
    'sql-test',
    'root',
    ''
);
// sqlite
// $db = new DataSource(
//     __DIR__ . "/database.sqlite"
// );

// ==========================
// テーブル作成
// ==========================

$sql = "
CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(32) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
)
";
// sqlite
// $sql = "
// CREATE TABLE IF NOT EXISTS users (
//     id TEXT PRIMARY KEY,
//     name TEXT NOT NULL,
//     email TEXT NOT NULL UNIQUE,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
// )
// ";

$db->execute($sql);

$sql = "
CREATE TABLE IF NOT EXISTS user_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(32) NOT NULL,
    action VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)
";
// sqlite
// $sql = "
// CREATE TABLE IF NOT EXISTS user_logs (
//     id INTEGER PRIMARY KEY AUTOINCREMENT,
//     user_id TEXT NOT NULL,
//     action TEXT NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP
// )
// ";

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
