<?php

namespace App\Message;

class ReceiveOrderMessage
{
    public function __construct(
        public string $orderUuid,
        public string $orderAddress,
        public string $userUuid,
        public string $status
    )
    {

    }
}