<?php

namespace PeduliRasa\Domain;

class User
{
    public ?int $id = null;
    public string $username;
    public string $email;
    public string $password;
    public string $phoneNumber;
    public ?string $profilePhoto = null;
}