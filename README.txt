更新処理の場合

SQLiteでは以下のように updated_at を更新します。

$id = "更新するID";

$sql = "
UPDATE users
SET
    name = :name,
    email = :email,
    updated_at = CURRENT_TIMESTAMP
WHERE id = :id
";


$db->execute($sql, [
    ':id' => $id,
    ':name' => '変更後ユーザー',
    ':email' => 'update@example.com'
]);
MySQLとSQLiteの違い
項目	MySQL	SQLite
文字列型	VARCHAR	TEXT
日時	DATETIME	DATETIME(TEXT保存)
自動更新	ON UPDATE可能	不可
更新日時	DB自動	UPDATE文で設定

この DataSource クラスなら、MySQL版とSQLite版で変更する場所は 接続部分とCREATE TABLEの型だけ なので、React + PHP API化する場合も共通化しやすい構成になります。
