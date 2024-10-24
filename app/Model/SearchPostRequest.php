<?php

namespace PeduliRasa\Model;

class SearchPostRequest
{
    public ?string $title = null;
    public ?array $categories = null;
    public int $page = 1;
}