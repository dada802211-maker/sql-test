# PHP PDO DataSource CRUD Example

PHPのPDOを利用したデータベース操作サンプルです。

対応データベース：

- MySQL
- SQLite

`DataSource` クラスを使用して、データベース接続・SQL実行・取得処理を共通化しています。

---

## 環境

- PHP 8.x
- PDO
- MySQL 8.x / MariaDB
- SQLite3

---

## ディレクトリ構成
project/
│
├── README.md
│
├── db/
│ └── DataSource.php
│
├── database.sqlite
│
└── test.php


---

# DataSourceクラス

`DataSource.php` はPDO接続をシングルトン管理します。

機能：

- SELECT
- INSERT
- UPDATE
- DELETE
- トランザクション
- プレースホルダー利用
- PDO例外処理

---

# MySQL設定

## データベース作成

```sql
CREATE DATABASE test_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
接続
$db = new DataSource(
    'localhost',
    '3306',
    'test_db',
    'root',
    ''
);
SQLite設定

SQLiteはデータベースファイルを指定します。

$db = new DataSource(
    __DIR__ . "/database.sqlite"
);
テーブル作成

usersテーブルを作成します。

CREATE TABLE IF NOT EXISTS users (
    id TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT

データ追加例

$id = bin2hex(random_bytes(16));

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
    ':id' => $id,
    ':name' => 'テストユーザー',
    ':email' => 'test@example.com'
]
);
SELECT
全件取得
$users = $db->select(
    "SELECT * FROM users"
);

print_r($users);

結果例：

[
    {
        id: xxx,
        name: テストユーザー,
        email: test@example.com,
        created_at: 2026-07-31 20:00:00,
        updated_at: 2026-07-31 20:00:00
    }
]
1件取得
$user = $db->selectOne(
    "
    SELECT *
    FROM users
    WHERE id=:id
    ",
    [
        ':id'=>$id
    ]
);
UPDATE
MySQL
UPDATE users
SET name=:name,
updated_at=CURRENT_TIMESTAMP
WHERE id=:id
SQLite

SQLiteでは ON UPDATE CURRENT_TIMESTAMP が利用できないため、

UPDATE users
SET
name=:name,
updated_at=CURRENT_TIMESTAMP
WHERE id=:id

のように更新時に指定します。

DELETE
$db->execute(
"
DELETE FROM users
WHERE id=:id
",
[
    ':id'=>$id
]
);
トランザクション
try {

    $db->begin();


    // INSERT
    // UPDATE
    // DELETE


    $db->commit();

} catch(Exception $e){

    $db->rollback();

}
ID生成

文字列IDにはUUID形式またはランダム文字列を利用できます。

例：

$id = bin2hex(random_bytes(16));

生成例：

a8f4c2e91d3b7a8f6c5e4d3b2a1f0001
注意事項
SQLインジェクション対策

SQLには直接値を入れず、
必ずプレースホルダーを使用します。

悪い例：

$sql = "
SELECT *
FROM users
WHERE email='$email'
";

良い例：

$sql = "
SELECT *
FROM users
WHERE email=:email
";
今後追加予定
REST API化
React連携
ログイン認証
セッション管理
CRUD画面作成
バリデーション追加
License

MIT License


このREADMEは、現在作成している **PHP + Reactフロントエンド用バックエンドAPIの土台** として、そのままGitHubに置ける構成にしています。
