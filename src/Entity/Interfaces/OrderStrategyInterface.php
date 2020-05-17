<?php


namespace App\Entity\Interfaces;


use App\Service\Serializer\SerializerService;

interface OrderStrategyInterface
{
    public const SERVICE_TAG = 'order_type';

    public function isOrderable(string $orderType): bool;

    public function sendOrder(object $orderType, string $sendType, SerializerService $serializerService);
}