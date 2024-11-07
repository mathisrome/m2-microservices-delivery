<?php

namespace App\MessageHandler;

use App\Enums\OrderStatus;
use App\Message\OrderStatusMessage;
use App\Repository\DeliveryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class OrderStatusMessageHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly DeliveryRepository $deliveryRepo,
    )
    {
    }

    public function __invoke(OrderStatusMessage $message)
    {
        $delivery = $this->deliveryRepo->findOneBy(['orderUuid' => $message->orderUuid]);
        $delivery->setStatus(OrderStatus::fromString($message->status));

        $this->em->persist($delivery);
        $this->em->flush();
    }
}