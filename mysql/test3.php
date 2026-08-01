<?php
// http://localhost/sql-test/mysql/test3.php
require_once "db/DataSource.php";
require_once "models/User.php";

use db\DataSource;
use models\User;

// DB接続
$db = new DataSource(
    'localhost',
    '3306',
    'sql-test',
    'root',
    ''
);

// テーブル作成（そのままでOK）
$db->execute("
CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(32) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
)
");

// モデル生成
$userModel = new User($db);

// ==========================
// データ追加
// ==========================
$userId = $userModel->create(
    'テストユーザー',
    'test@example.com'
);

// ==========================
// データ取得
// ==========================
$users = $userModel->findAll();

echo "<pre>";
print_r($users);
echo "</pre>";
