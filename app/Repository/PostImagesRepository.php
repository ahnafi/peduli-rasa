<?php

namespace PeduliRasa\Repository;

use PeduliRasa\Domain\PostImage;

class PostImagesRepository
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(PostImage $postImage): PostImage
    {
        $statement = $this->connection->prepare("INSERT INTO post_images (post_id, image_name) VALUES (?, ?)");
        $statement->execute([$postImage->postId, $postImage->imageName]);
        return $postImage;
    }

    public function findByPostId(int $postId): array
    {
        $statement = $this->connection->prepare("SELECT image_id,post_id,image_name FROM post_images WHERE post_id = ?");
        $statement->execute([$postId]);

        $data = [];
        while ($rows = $statement->fetchAll(\PDO::FETCH_ASSOC)) {
            $row = new PostImage();
            $row->id = $rows['image_id'];
            $row->postId = $rows['post_id'];
            $row->imageName = $rows['image_name'];

            $data[] = $row;
        }

        return $data;

    }

    public function update(PostImage $postImage): PostImage
    {
        $statement = $this->connection->prepare("UPDATE post_images SET image_name = ? WHERE image_id = ?");
        $statement->execute([$postImage->imageName, $postImage->id]);
        return $postImage;
    }

    public function delete(int $postImageId): void
    {
        $statement = $this->connection->prepare("DELETE FROM post_images WHERE image_id = ?");
        $statement->execute([$postImageId]);
    }

    public function deleteAll(): void
    {
        $statement = $this->connection->prepare("DELETE FROM post_images");
        $statement->execute();
    }

}