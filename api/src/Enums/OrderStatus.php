<?php

namespace App\Enums;

enum OrderStatus: string
{
    case WAITING = 'waiting';
    case READY = 'ready';
    case IN_DELIVERY = 'in_delivery';
    case DELIVERED = 'delivered';

    public static function fromInt(int $number): ?OrderStatus
    {
        $status = null;
        switch ($number) {
            case 1:
                $status = OrderStatus::WAITING;
                break;
            case 2:
                $status = OrderStatus::READY;
                break;
            case 3:
                $status = OrderStatus::IN_DELIVERY;
                break;
            case 4:
                $status = OrderStatus::DELIVERED;
                break;
        }

        return $status;
    }

    public static function fromString(string $string): ?OrderStatus
    {

        $status = null;
        switch ($string) {
            case "En préparation":
            case "En attente":
                $status = OrderStatus::WAITING;
                break;
            case "Prêt à servir":
                $status = OrderStatus::READY;
                break;
        }

        return $status;
    }
}