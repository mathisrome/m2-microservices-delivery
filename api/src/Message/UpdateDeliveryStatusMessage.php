<?php

namespace App\Message;

class UpdateDeliveryStatusMessage
{
    public function __construct(
        public string $deliveryUuid,
        public string $status,
    )
    {
    }
}