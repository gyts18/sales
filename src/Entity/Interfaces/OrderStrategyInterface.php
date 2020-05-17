<?php


namespace App\Entity\Interfaces;


interface OrderStrategyInterface
{
    public const SERVICE_TAG = 'order_type';
    public const ORDER_KEY = 'order';

    public function isOrderable(string $orderType): bool;

    public function sendOrder(object $orderType, string $sendType): void;
}