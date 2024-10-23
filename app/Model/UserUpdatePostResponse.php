<?php

namespace PeduliRasa\Model;

use PeduliRasa\Domain\Post;

class UserUpdatePostResponse
{
    public Post $post;
    public array $images = [];
}