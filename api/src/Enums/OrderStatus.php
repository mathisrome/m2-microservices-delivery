<?php

enum OrderStatus: string
{
    case WAITING = 'waiting';
    case READY = 'ready';
    case IN_DELIVERY = 'in_delivery';
    case DELIVERED = 'delivered';
}