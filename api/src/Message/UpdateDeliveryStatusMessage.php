<?php

namespace App\Message;

class UpdateDeliveryStatusMessage
{
    public function __construct(
        public readonly string $deliveryUuid,
        public readonly string $status,
    )
    {
    }
}