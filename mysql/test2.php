<?php

require_once "db/DataSource.php";

use db\DataSource;


// MySQL接続
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


try {

    // トランザクション開始
    $db->begin();


    // =========================
    // ユーザー登録
    // =========================

    $userId = bin2hex(random_bytes(16));

    $db->execute(
        "
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
        ",
        [
            ':id' => $userId,
            ':name' => '山田太郎',
            ':email' => 'yamada@example.com'
        ]
    );


    // =========================
    // 登録ログ追加
    // =========================

    $db->execute(
        "
        INSERT INTO user_logs (
            user_id,
            action
        )
        VALUES (
            :user_id,
            :action
        )
        ",
        [
            ':user_id' => $userId,
            ':action' => 'ユーザー登録'
        ]
    );


    // 正常終了
    $db->commit();


    echo "登録成功";


} catch(Exception $e) {


    // 失敗時は全部取り消し
    $db->rollback();


    echo "登録失敗:";
    echo $e->getMessage();

}
