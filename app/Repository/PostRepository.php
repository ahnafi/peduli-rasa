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
        $statement = $this->connection->prepare("INSERT INTO posts (title, description, post_date, location,user_id,category_id) VALUES (?,?,?,?,?,?)");
        $statement->execute([$post->title,
            $post->description,
            $post->postDate,
            $post->location,
            $post->userId,
            $post->categoryId]);
        $lastInsertId = $this->connection->lastInsertId();
        $post->id = $lastInsertId;
        return $post;
    }

    public function findById(int $id): ?Post
    {
        $statement = $this->connection->prepare("SELECT post_id,title,description,post_date,location,user_id,category_id FROM posts WHERE post_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $post = new Post();
                $post->id = $row['post_id'];
                $post->title = $row['title'];
                $post->description = $row['description'];
                $post->postDate = $row['post_date'];
                $post->location = $row['location'];
                $post->categoryId = $row['category_id'];
                $post->userId = $row['user_id'];
                return $post;
            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
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
        $params[] = $limit;
        $params[] = $offset;

        // Eksekusi query
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        try {
            $posts = [];
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
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

            return $posts;
        } finally {
            $statement->closeCursor();
        }
    }

    public function update(Post $post): Post
    {
        $statement = $this->connection->prepare("UPDATE posts SET title = ? ,description = ? , post_date = ? ,location = ? ,category_id =? WHERE post_id = ? ");
        $statement->execute([$post->title, $post->description, $post->postDate, $post->location, $post->categoryId, $post->id]);
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