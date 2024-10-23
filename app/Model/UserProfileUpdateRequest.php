<?php

namespace PeduliRasa\Model;

class UserProfileUpdateRequest
{
    public ?string $username = null;
    public ?string $email = null;
    public ?string $phoneNumber = null;
    public ?array $profilePhoto = null;
}
