<?php

namespace App\Message;

class ReceiveOrderMessage
{
    public function __construct(
        public readonly string $orderUuid,
        public readonly string $orderAddress,
        public readonly string $userUuid,
        public readonly string $status
    )
    {

    }
}