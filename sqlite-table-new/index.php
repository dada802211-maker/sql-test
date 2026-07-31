<?php
try {
    // SQLite接続（ファイルDB）
    $pdo = new PDO("sqlite:" . __DIR__ . "/../database.sqlite", null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // テーブル作成（なければ）
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id TEXT PRIMARY KEY,
            name TEXT NOT NULL,
            email TEXT NOT NULL
        )
    ");

    echo "テーブルOK";
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// http://localhost/sql-test/sqlite-table-new/
