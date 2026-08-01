<?php
namespace models;

class User
{
    public string $id;
    public string $name;
    public string $email;
    // public string $created_at;
    // public string $updated_at;

    // ドメインロジックも書ける
    public function isTestUser(): bool
    {
        return $this->name === 'テストユーザー';
    }
}
