<?php

namespace App\Message;

class ReceiveCustomerMessage
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly string $phoneNumber,
    )
    {
    }
}