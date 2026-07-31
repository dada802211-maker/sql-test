<?php
$host = 'localhost';
$dbname = 'sql-test';
$user = 'root';
$pass = '';

try {
    // PDO接続
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // テーブル作成（存在しなければ）
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    $pdo->exec($sql);

    echo "テーブル確認/作成完了";
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// http://localhost/sql-test/mysql-table-new/
