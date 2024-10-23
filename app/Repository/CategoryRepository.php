<?php

namespace PeduliRasa\Repository;

use PeduliRasa\Domain\Category;

class CategoryRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function create(Category $category): void
    {
        $statement = $this->connection->prepare("INSERT INTO categories (name) VALUES (?,?)");
        $statement->execute([$category->name]);
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT category_id,name FROM categories");
        $statement->execute();

        try {
            $data = [];
            while ($rows = $statement->fetchAll(\PDO::FETCH_ASSOC)) {
                $row = new Category();
                $row->id = $rows['category_id'];
                $row->name = $rows['name'];

                $data[] = $row;
            }
            return $data;
        } finally {
            $statement->closeCursor();
        }
    }

    public function find(int $id): ?Category
    {
        $statement = $this->connection->prepare("SELECT category_id,name FROM categories WHERE category_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $category = new Category();
                $category->id = $row['category_id'];
                $category->name = $row['name'];
                return $category;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function update(Category $category): void {
        $statement = $this->connection->prepare("UPDATE categories SET name=? WHERE category_id=?");
        $statement->execute([$category->name, $category->id]);
    }

    public function delete(int $id): void {
        $statement = $this->connection->prepare("DELETE FROM categories WHERE category_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll (){
        $statement = $this->connection->prepare("DELETE FROM categories");
    }
}