<?php
// http://localhost/sql-test/mysql/test4.php
require_once "db/DataSource.php";
require_once "models/user.entity2.php";
require_once "Repository/user.repository.php";

use db\DataSource;
use models\UserRepository;

// DB接続
$db = new DataSource();

// Repository
$userRepo = new UserRepository($db);

// 作成
$userId = $userRepo->create(
    'テストユーザー',
    'test5@example.com'
);

// 全件取得（オブジェクトで返る）
$users = $userRepo->findAll();

echo "<pre>";

foreach ($users as $user) {
    echo "ID: {$user->id}\n";
    echo "名前: {$user->name}\n";
    echo "メール: {$user->email}\n";

    if ($user->isTestUser()) {
        echo "👉 テストユーザーです\n";
    }

    echo "-----------------\n";
}

echo "</pre>";
