<?php

namespace App\Message;

class OrderStatusMessage
{
    public function __construct(
        public string $orderUuid,
        public string $status,
    )
    {
    }
}