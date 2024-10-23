<?php

namespace PeduliRasa\Model;

class UserPasswordUpdateRequest
{
    public ?string $email = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}