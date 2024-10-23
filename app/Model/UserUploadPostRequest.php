<?php

namespace PeduliRasa\Model;

class UserUploadPostRequest
{
    public ?string $userId = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?\DateTime $postDate = null;
    public ?string $location = null;
    public ?int $categoryId = null;
    public ?array $photos = null;
}
