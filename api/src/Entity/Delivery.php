<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryRepository::class)]
class Delivery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $orderId = null;

    #[ORM\Column(length: 255)]
    private ?string $restaurantId = null;

    #[ORM\Column(length: 255)]
    private ?string $restaurantName = null;

    #[ORM\Column(length: 255)]
    private ?string $restaurantAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $userId = null;

    #[ORM\Column(length: 255)]
    private ?string $userFirstname = null;

    #[ORM\Column(length: 255)]
    private ?string $userAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getRestaurantId(): ?string
    {
        return $this->restaurantId;
    }

    public function setRestaurantId(string $restaurantId): static
    {
        $this->restaurantId = $restaurantId;

        return $this;
    }

    public function getRestaurantName(): ?string
    {
        return $this->restaurantName;
    }

    public function setRestaurantName(string $restaurantName): static
    {
        $this->restaurantName = $restaurantName;

        return $this;
    }

    public function getRestaurantAddress(): ?string
    {
        return $this->restaurantAddress;
    }

    public function setRestaurantAddress(string $restaurantAddress): static
    {
        $this->restaurantAddress = $restaurantAddress;

        return $this;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): static
    {
        $this->userId = $userId;

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

    public function getUserAddress(): ?string
    {
        return $this->userAddress;
    }

    public function setUserAddress(string $userAddress): static
    {
        $this->userAddress = $userAddress;

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
