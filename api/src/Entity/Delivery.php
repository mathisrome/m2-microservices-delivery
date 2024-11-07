<?php

namespace App\Entity;

use App\Enums\OrderStatus;
use App\Repository\DeliveryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: DeliveryRepository::class)]
class Delivery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["delivery:detail"])]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid')]
    #[Groups(["delivery:detail"])]
    private ?Uuid $uuid = null;

    #[ORM\Column(type: 'uuid')]
    #[Groups(["delivery:detail"])]
    private ?Uuid $orderUuid = null;

    #[ORM\Column(length: 255,enumType: OrderStatus::class)]
    #[Groups(["delivery:detail"])]
    private ?OrderStatus $status = null;

    #[ORM\Column(length: 255)]
    #[Groups(["delivery:detail"])]
    private ?string $orderAddress = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable:   false)]
    #[Groups(["delivery:detail"])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'deliveries')]
    #[Groups(["delivery:detail"])]
    private ?User $deliverer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getOrderUuid(): ?Uuid
    {
        return $this->orderUuid;
    }

    public function setOrderUuid(Uuid $orderUuid): static
    {
        $this->orderUuid = $orderUuid;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(OrderStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getOrderAddress(): ?string
    {
        return $this->orderAddress;
    }

    public function setOrderAddress(string $orderAddress): static
    {
        $this->orderAddress = $orderAddress;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDeliverer(): ?User
    {
        return $this->deliverer;
    }

    public function setDeliverer(?User $deliverer): static
    {
        $this->deliverer = $deliverer;

        return $this;
    }
}
