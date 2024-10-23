<?php

namespace PeduliRasa\Model;

class UserRegisterRequest
{
    public ?string $username = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $phoneNumber = null;
}