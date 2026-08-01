<?php
namespace models;

use db\DataSource;

class UserRepository
{
    private DataSource $db;

    public function __construct(DataSource $db)
    {
        $this->db = $db;
    }

    // 作成
    public function create(string $name, string $email): string
    {
        $id = bin2hex(random_bytes(16));

        $this->db->execute(
            "INSERT INTO users (id, name, email)
             VALUES (:id, :name, :email)",
            [
                ':id' => $id,
                ':name' => $name,
                ':email' => $email
            ]
        );

        return $id;
    }

    // 全件取得（🔥ここがOOP化ポイント）
    public function findAll(): array
    {
        return $this->db->select(
            "SELECT * FROM users",
            [],
            DataSource::CLS,
            User::class
        );
    }

    // 1件取得
    public function findById(string $id): ?User
    {
        $user = $this->db->selectOne(
            "SELECT * FROM users WHERE id = :id",
            [':id' => $id],
            DataSource::CLS,
            User::class
        );

        return $user ?: null;
    }

    // 更新
    public function update(User $user): void
    {
        $this->db->execute(
            "UPDATE users
             SET name = :name,
                 email = :email,
                 updated_at = CURRENT_TIMESTAMP
             WHERE id = :id",
            [
                ':id' => $user->id,
                ':name' => $user->name,
                ':email' => $user->email
            ]
        );
    }

    // 削除
    public function delete(string $id): void
    {
        $this->db->execute(
            "DELETE FROM users WHERE id = :id",
            [':id' => $id]
        );
    }
}
