<?php
$host = 'localhost';
$dbname = 'sql-test';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // 削除対象のID
    $id = "d4ff1616cc91547e03e797900ca54322";

    $stmt = $pdo->prepare("
        DELETE FROM users
        WHERE id = :id
    ");

    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        echo "削除成功";
    } else {
        echo "対象データが見つかりません";
    }

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// http://localhost/sql-test/mysql-delete/
