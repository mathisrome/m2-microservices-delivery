<?php

namespace App\MessageHandler;
use App\Entity\Delivery;
use App\Message\ReceiveOrderMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
class ReceiveOrderMessageHandler
{
   public function __construct(
       private readonly EntityManagerInterface $entityManager,
   )
   {
   }

   public function __invoke(ReceiveOrderMessage $message)
   {
        $delivery = new Delivery();
        $delivery->setUuid(Uuid::v4());
        $delivery->setOrderUuid(new Uuid($message->orderUuid));
        $delivery->setUserUuid(new Uuid($message->userUuid));
        $delivery->setUserFirstname($message->userFirstname);
        $delivery->setUserLastname($message->userLastname);
        $delivery->setUserAddress($message->userAddress);
        $delivery->setUserPhoneNumber($message->userPhoneNumber);
        $delivery->setStatus($message->status);

        $this->entityManager->persist($delivery);
        $this->entityManager->flush();
   }
}