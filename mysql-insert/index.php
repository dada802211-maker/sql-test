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

    // ユニークID生成（ランダム16進数）
    $id = bin2hex(random_bytes(16)); // 例: 32文字のランダム文字列

    $name = "テストユーザー";
    $email = "test@example.com";

    // INSERT
    $stmt = $pdo->prepare("
        INSERT INTO users (id, name, email)
        VALUES (:id, :name, :email)
    ");

    $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':email' => $email
    ]);

    echo "データ作成成功 ID: " . $id;

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// http://localhost/sql-test/mysql-insert/
