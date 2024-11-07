<?php

namespace App\MessageHandler;
use App\Entity\Delivery;
use App\Enums\OrderStatus;
use App\Message\OrderMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
class OrderMessageHandler
{
   public function __construct(
       private readonly EntityManagerInterface $entityManager,
       private readonly UserRepository $userRepository,
   )
   {
   }

   public function __invoke(OrderMessage $message)
   {
        $delivery = new Delivery();
        $delivery->setUuid(Uuid::v4());
        $delivery->setOrderUuid(new Uuid($message->uuid));
        $delivery->setOrderAddress(
            sprintf(
                "%s %s %s %s %s",
                $message->address1,
                $message->address2,
                $message->postalCode,
                $message->city,
                $message->country,
            )
        );

        $delivery->setStatus(OrderStatus::fromInt($message->status));

        $user = $this->userRepository->findOneBy(['uuid' => $message->user]);
        $delivery->setUser($user);

        $this->entityManager->persist($delivery);
        $this->entityManager->flush();
   }
}