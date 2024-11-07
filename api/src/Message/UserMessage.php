<?php

namespace App\Message;

final class UserMessage
{
    public function __construct(
        public string $uuid,
        public string $firstName,
        public string $lastName,
        public string $phoneNumber,
    )
    {
    }
}