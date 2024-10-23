<?php

namespace PeduliRasa\Repository;

use PeduliRasa\Domain\User;
use PeduliRasa\Exception\ValidationException;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(username, email, password,phone_number) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $user->username,$user->email, $user->password,$user->phoneNumber
        ]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET username = ?, password = ? ,phone_number = ?,profile_photo = ? WHERE user_id = ?");
        $statement->execute([
            $user->username, $user->password,$user->phoneNumber,$user->profilePhoto, $user->id
        ]);
        return $user;
    }

    public function findUserByField(string $field, string $value): ?User
    {
        // Pastikan hanya field yang valid yang digunakan
        if (!in_array($field, ['user_id', 'email'])) {
            throw new ValidationException("Field tidak valid untuk pencarian user");
        }

        $statement = $this->connection->prepare("SELECT user_id, username, email, password, phone_number, profile_photo FROM users WHERE $field = ?");
        $statement->execute([$value]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['user_id'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->phoneNumber = $row['phone_number'];
                $user->profilePhoto = $row['profile_photo'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from users");
    }
}