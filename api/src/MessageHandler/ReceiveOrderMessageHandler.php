<?php

namespace App\MessageHandler;
use App\Entity\Delivery;
use App\Message\ReceiveOrderMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
class ReceiveOrderMessageHandler
{
   public function __construct(
       private readonly EntityManagerInterface $entityManager,
       private readonly UserRepository $userRepository,
   )
   {
   }

   public function __invoke(ReceiveOrderMessage $message)
   {
        $delivery = new Delivery();
        $delivery->setUuid(Uuid::v4());
        $delivery->setOrderUuid(new Uuid($message->orderUuid));
        $delivery->setUserUuid(new Uuid($message->userUuid));
        $delivery->setOrderAddress($message->orderAddress);
        $delivery->setStatus($message->status);

        $user = $this->userRepository->findOneBy(['uuid' => $message->userUuid]);
        $delivery->setUser($user);

        $this->entityManager->persist($delivery);
        $this->entityManager->flush();
   }
}