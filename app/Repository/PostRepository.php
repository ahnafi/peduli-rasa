<?php

namespace PeduliRasa\Repository;

use PeduliRasa\Domain\Post;

class PostRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Post $post): Post
    {
        $postDate = $post->postDate->format('Y-m-d H:i:s');

        $statement = $this->connection->prepare("INSERT INTO posts (title, description, post_date, location, user_id, category_id) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->execute([$post->title,
            $post->description,
            $postDate,
            $post->location,
            $post->userId,
            $post->categoryId]);

        $lastInsertId = $this->connection->lastInsertId();
        $post->id = $lastInsertId;
        return $post;
    }


    public function findById(int $id): ?Post
    {
        $statement = $this->connection->prepare("SELECT post_id,title,description,post_date,location,user_id,category_id, created_at FROM posts WHERE post_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $post = new Post();
                $post->id = $row['post_id'];
                $post->title = $row['title'];
                $post->description = $row['description'];
                $post->postDate = new \DateTime($row['post_date']);
                $post->location = $row['location'];
                $post->categoryId = $row['category_id'];
                $post->userId = $row['user_id'];
                $post->timeStamp = $row['created_at'];
                return $post;
            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }

    public function findByUser(int $userId, int $page = 1): ?array
    {
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // Query SQL untuk mengambil data berdasarkan user_id, dengan pagination
        $query = "SELECT post_id, title, description, post_date, location, user_id, category_id 
              FROM posts 
              WHERE user_id = ? 
              LIMIT $limit OFFSET $offset"; // Memasukkan nilai $limit dan $offset langsung dalam query

        $statement = $this->connection->prepare($query);
        $statement->execute([$userId]);

        $posts = [];
        while ($rows = $statement->fetchAll()) {
            foreach ($rows as $row) {
                $post = new Post();
                $post->id = $row['post_id'];
                $post->title = $row['title'];
                $post->description = $row['description'];
                $post->postDate = new \DateTime($row['post_date']);
                $post->location = $row['location'];
                $post->userId = $row['user_id'];
                $post->categoryId = $row['category_id'];
                $posts[] = $post;
            }
        }

        return $posts;
    }


    public function search(?string $title, ?array $categories, int $page = 1): array
    {
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // Buat query dasar
        $query = "SELECT post_id, title, description, post_date, location, user_id, category_id FROM posts WHERE 1=1";

        // Tambahkan kondisi jika title tidak null
        $params = [];
        if ($title != null) {
            $query .= " AND title LIKE ?";
            $params[] = '%' . $title . '%';  // Like search
        }

        // Tambahkan kondisi untuk kategori jika ada
        if (!empty($categories)) {
            $query .= " AND category_id IN (" . implode(',', array_fill(0, count($categories), '?')) . ")";
            $params = array_merge($params, $categories);
        }

        // Tambahkan limit dan offset untuk pagination
        $query .= " LIMIT ? OFFSET ?";
        // Eksekusi query
        $statement = $this->connection->prepare($query);

        // Bind nilai limit dan offset secara eksplisit dengan tipe data integer
        foreach ($params as $index => $param) {
            $statement->bindValue($index + 1, $param); // Bind nilai lainnya
        }
        $statement->bindValue(count($params) + 1, $limit, \PDO::PARAM_INT);  // Bind limit sebagai integer
        $statement->bindValue(count($params) + 2, $offset, \PDO::PARAM_INT); // Bind offset sebagai integer

        $statement->execute();

        $posts = [];
        while ($rows = $statement->fetchAll()) {
            foreach ($rows as $row) {
                $post = new Post();
                $post->id = $row['post_id'];
                $post->title = $row['title'];
                $post->description = $row['description'];
                $post->postDate = new \DateTime($row['post_date']);
                $post->location = $row['location'];
                $post->userId = $row['user_id'];
                $post->categoryId = $row['category_id'];
                $posts[] = $post;
            }
        }

        return $posts;
    }

    public function update(Post $post): Post
    {
        $postDate = $post->postDate->format('Y-m-d H:i:s');
        $statement = $this->connection->prepare("UPDATE posts SET title = ? ,description = ? , post_date = ? ,location = ? ,category_id =? WHERE post_id = ? ");
        $statement->execute([$post->title, $post->description, $postDate, $post->location, $post->categoryId, $post->id]);
        return $post;
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM posts WHERE post_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $statement = $this->connection->prepare("DELETE FROM posts");
        $statement->execute();
    }

}