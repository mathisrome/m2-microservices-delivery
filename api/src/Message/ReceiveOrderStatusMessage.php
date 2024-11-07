<?php

namespace App\Message;

class ReceiveOrderStatusMessage
{
    public function __construct(
        public string $orderUuid,
        public string $status,
    )
    {
    }
}