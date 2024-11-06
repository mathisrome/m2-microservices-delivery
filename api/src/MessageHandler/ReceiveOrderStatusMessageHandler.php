<?php

namespace App\MessageHandler;

use App\Message\ReceiveOrderStatusMessage;
use App\Repository\DeliveryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ReceiveOrderStatusMessageHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly DeliveryRepository $deliveryRepo,
    )
    {
    }

    public function __invoke(ReceiveOrderStatusMessage $message)
    {
        $delivery = $this->deliveryRepo->findOneBy(['orderUuid' => $message->orderUuid]);
        $delivery->setStatus($message->status);

        $this->em->persist($delivery);
        $this->em->flush();
    }
}