<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\UserMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
class UserMessageHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
    )
    {
    }

    public function __invoke(UserMessage $message)
    {
        $user = $this->userRepository->findOneBy(['uuid' => $message->uuid]);

        if (null === $user) {
            $user = new User();
            $user->setUuid(new Uuid($message->uuid));
        }

        $user->setFirstname($message->firstName);
        $user->setLastname($message->lastName);
        $user->setPhoneNumber($message->phoneNumber);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}