<?php

require_once "db/DataSource.php";

use db\DataSource;

$db = new DataSource();

$result = $db->select(
    "SELECT * FROM users"
);

print_r($result);

/*
SQLiteの場合の注意点
1. lastInsertId()

SQLiteでもそのまま使えます。

$id = $db->lastInsertId();

ただし、対象カラムが：

id INTEGER PRIMARY KEY AUTOINCREMENT

の場合です。

2. SQLiteでは不要なもの

MySQL用だった：

$host
$port
$dbName
$username
$password

は不要になります。

SQLiteは：

sqlite:database.sqlite

だけで接続できます。

3. 以前作成した文字列IDの場合

例えば：

CREATE TABLE users (
    id TEXT PRIMARY KEY,
    name TEXT,
    email TEXT
)

なら、

$id = bin2hex(random_bytes(16));

で作成してINSERTする形になります。

この DataSource クラスは、以前作られていた React + PHP + SQLite API構成 にそのまま使える形です。
*/
