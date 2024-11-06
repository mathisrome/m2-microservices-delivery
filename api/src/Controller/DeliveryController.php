<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Message\UpdateDeliveryStatusMessage;
use App\Repository\DeliveryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/delivery/')]
class DeliveryController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private DeliveryRepository $deliveryRepository,
    )
    {}

    // Route de test
    #[Route('ping', name: 'ping', methods: ['GET'])]
    public function ping(): Response
    {
        return $this->json('pong');
    }

    // Liste de toutes les commandes pour les livreurs
    #[Route('list', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        return $this->json($this->deliveryRepository->findAll());
    }

    // Apperçu d'une commande pour le livreur
    #[Route('{id}', name: 'delivery', methods: ['GET'])]
    public function delivery(Delivery $delivery): Response
    {
        return $this->json($delivery);
    }

    #[Route('/{id}', name: 'delivery', methods: ['PUT'])]
    public function deliveryUpdate(Request $request, EntityManagerInterface $manager, MessageBusInterface $bus, Delivery $delivery): Response
    {
        $delivery->setStatus($request->request->get('status'));

        $manager->persist($delivery);
        $manager->flush();

        $bus->dispatch(new UpdateDeliveryStatusMessage($delivery->getUuid(), $delivery->getStatus()));

        return $this->json($delivery);
    }

}
