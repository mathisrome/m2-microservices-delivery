<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: DeliveryRepository::class)]
class Delivery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $orderUuid = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $userUuid = null;

    #[ORM\Column(length: 255)]
    private ?string $userFirstname = null;

    #[ORM\Column(length: 255)]
    private ?string $userLastname = null;

    #[ORM\Column(length: 255)]
    private ?string $userAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $userPhoneNumber = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $delivererUuid = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

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

    public function getUserUuid(): ?Uuid
    {
        return $this->userUuid;
    }

    public function setUserUuid(Uuid $userUuid): static
    {
        $this->userUuid = $userUuid;

        return $this;
    }

    public function getUserFirstname(): ?string
    {
        return $this->userFirstname;
    }

    public function setUserFirstname(string $userFirstname): static
    {
        $this->userFirstname = $userFirstname;

        return $this;
    }

    public function getUserLastname(): ?string
    {
        return $this->userLastname;
    }

    public function setUserLastname(string $userLastname): static
    {
        $this->userLastname = $userLastname;

        return $this;
    }

    public function getUserAddress(): ?string
    {
        return $this->userAddress;
    }

    public function setUserAddress(string $userAddress): static
    {
        $this->userAddress = $userAddress;

        return $this;
    }

    public function getUserPhoneNumber(): ?string
    {
        return $this->userPhoneNumber;
    }

    public function setUserPhoneNumber(string $userPhoneNumber): static
    {
        $this->userPhoneNumber = $userPhoneNumber;

        return $this;
    }

    public function getDelivererUuid(): ?Uuid
    {
        return $this->delivererUuid;
    }

    public function setDelivererUuid(Uuid $delivererUuid): static
    {
        $this->delivererUuid = $delivererUuid;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
