<?php
$host = 'localhost';
$dbname = 'sql-test';
$user = 'root';
$pass = '';

// PDO接続
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// 更新対象のID（作成時に生成したIDを指定）
$id = "d4ff1616cc91547e03e797900ca54322";
// 更新後のデータ
$name = "更新後ユーザー2";
$email = "updated@example.com";

$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE id = :id");
$stmt->execute([':id' => $id]);
if ($stmt->fetchColumn() == 0) {
    exit("データが存在しません");
}

try {
    // UPDATE文
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

    if ($stmt->rowCount() > 0) {
        echo "更新成功";
    } else {
        echo "対象データが見つからないか、変更がありません";
    }

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

// http://localhost/sql-test/mysql-update/
