<?php

namespace App\Message;

class ReceiveOrderMessage
{
    public function __construct(
        public readonly string $orderUuid,
        public readonly string $userUuid,
        public readonly string $userFirstname,
        public readonly string $userLastname,
        public readonly string $userAddress,
        public readonly string $userPhoneNumber,
        public readonly string $status
    )
    {

    }
}