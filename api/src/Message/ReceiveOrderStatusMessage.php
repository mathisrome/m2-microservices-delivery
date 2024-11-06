<?php

namespace App\Message;

class ReceiveOrderStatusMessage
{
    public function __construct(
        public readonly string $orderUuid,
        public readonly string $status,
    )
    {
    }
}