<?php

namespace PeduliRasa\Domain;

class Post
{
    public ?string $id = null;
    public string $title;
    public string $description;
    public \DateTime $postDate;
    public string $location;
    public int $userId;
    public int $categoryId;
    public ?string $timeStamp = null;
}