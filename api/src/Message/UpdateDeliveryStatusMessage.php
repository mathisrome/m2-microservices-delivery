<?php

namespace App\Message;

class UpdateDeliveryStatusMessage
{
    public function __construct(
        public string $orderUuid,
        public string $status,
    )
    {
    }
}