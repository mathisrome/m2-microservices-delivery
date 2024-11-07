<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\ReceiveCustomerMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class ReceiveCustomerHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
    )
    {
    }

    public function __invoke(ReceiveCustomerMessage $message)
    {
        $user = $this->userRepository->findOneBy(['uuid' => $message->uuid]);

        if (null === $user) {
            $user = new User();
            $user->setUuid(new Uuid($message->uuid));
        }

        $user->setFirstname($message->firstname);
        $user->setLastname($message->lastname);
        $user->setPhoneNumber($message->phoneNumber);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}