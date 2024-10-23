<?php

namespace PeduliRasa\Model;

class UserUpdatePostRequest
{
    public ?string $postId = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?\DateTime $postDate = null;
    public ?string $location = null;
    public ?int $categoryId = null;
    public ?string $userEmail = null;
}