<?php

namespace App\Message;

class OrderMessage
{
    public function __construct(
        public string $uuid,
        public string $user,
        public string $address1,
        public ?string $address2,
        public string $city,
        public string $country,
        public string $postalCode,
        public int $status
    )
    {

    }
}