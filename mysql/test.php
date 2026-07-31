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
