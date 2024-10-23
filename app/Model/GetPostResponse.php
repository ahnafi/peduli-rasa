<?php

namespace PeduliRasa\Model;

use PeduliRasa\Domain\Post;

class GetPostResponse
{
    public Post $post;
    public array $images = [];
}