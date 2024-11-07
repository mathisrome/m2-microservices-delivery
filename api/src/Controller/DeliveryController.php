<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Entity\User;
use App\Message\UpdateDeliveryStatusMessage;
use App\Repository\DeliveryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/deliveries')]
class DeliveryController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private DeliveryRepository $deliveryRepository,
    ){

    }

    // Liste de toutes les commandes pour les livreurs
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        $deliveries = $this->deliveryRepository->findAll();

        return $this->json($deliveries);
    }

    #[Route('/{id}', name: 'attribuateDeliverer', methods: ['POST'])]
    public function attribuateDeliverer(
        Request                $request,
        EntityManagerInterface $em,
        Delivery               $delivery
    )
    {
        $body = json_decode($request->getContent(), true);

        $user = $em->getRepository(User::class)->findOneByUuid($body['uuid']);

        $delivery->setDeliverer($user);

        return $this->json($delivery);
    }

    // Aperçu d'une commande pour le livreur
    #[Route('/{id}', name: 'delivery', methods: ['GET'])]
    public function delivery(Delivery $delivery): Response
    {
        return $this->json($delivery);
    }

    #[Route('/{id}', name: 'delivery', methods: ['PUT'])]
    public function deliveryUpdate(Request $request, MessageBusInterface $bus, Delivery $delivery): Response
    {
        $delivery->setStatus($request->request->get('status'));

        $this->em->persist($delivery);
        $this->em->flush();

        $bus->dispatch(new UpdateDeliveryStatusMessage($delivery->getUuid(), $delivery->getStatus()));

        return $this->json($delivery);
    }

}
