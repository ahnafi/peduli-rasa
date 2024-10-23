<?php

namespace PeduliRasa\Domain;

class Post
{
    public ?string $id = null;
    public string $title;
    public string $description;
    public string $date;
    public string $location;
    public int $userId;
    public int $categoryId;
}