<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Repository\DeliveryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
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

    // Commande prête à être récupérée
    #[Route('{id}/isready', name: 'isready', methods: ['GET'])]
    public function isready(Delivery $delivery): Response
    {
        $delivery->setStatus(\OrderStatus::READY->value);
        $this->em->persist($delivery);
        $this->em->flush();

        return $this->json($delivery);
    }

    // Changer le status d'une commande comme livraison en cours
    #[Route('{id}/picked', name: 'delivery', methods: ['PUT'])]
    public function picked(Delivery $delivery): Response
    {
        $delivery->setStatus(\OrderStatus::IN_DELIVERY->value);
        $this->em->persist($delivery);
        $this->em->flush();

        return $this->json($delivery);
    }

    // Changer le status d'une commande comme livrée
    #[Route('{id}/delivered', name: 'delivery', methods: ['PUT'])]
    public function delivered(Delivery $delivery): Response
    {
        $delivery->setStatus(\OrderStatus::DELIVERED->value);
        $this->em->flush();

        return $this->json($delivery);
    }

    // Création d'une nouvelle commande
    #[Route('create', name: 'create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] Delivery $delivery,
        Request $request
    ): Response
    {
        $this->em->persist($delivery);
        $this->em->flush();

        return $this->json($delivery);
    }

}
