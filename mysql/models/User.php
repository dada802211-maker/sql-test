<?php
namespace models;

use db\DataSource;

class User
{
    private DataSource $db;

    public function __construct(DataSource $db)
    {
        $this->db = $db;
    }

    // ユーザー作成
    public function create(string $name, string $email): string
    {
        $id = bin2hex(random_bytes(16));

        $sql = "
        INSERT INTO users (id, name, email)
        VALUES (:id, :name, :email)
        ";

        $this->db->execute($sql, [
            ':id' => $id,
            ':name' => $name,
            ':email' => $email
        ]);

        return $id;
    }

    // 全件取得
    public function findAll(): array
    {
        return $this->db->select("SELECT * FROM users");
    }

    // IDで取得
    public function findById(string $id): ?array
    {
        $result = $this->db->select(
            "SELECT * FROM users WHERE id = :id",
            [':id' => $id]
        );

        return $result[0] ?? null;
    }

    // 更新
    public function update(string $id, string $name, string $email): void
    {
        $sql = "
        UPDATE users
        SET name = :name,
            email = :email,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = :id
        ";

        $this->db->execute($sql, [
            ':id' => $id,
            ':name' => $name,
            ':email' => $email
        ]);
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
