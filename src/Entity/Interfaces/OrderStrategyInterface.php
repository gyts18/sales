<?php


namespace App\Entity\Interfaces;


interface OrderStrategyInterface
{
	public const ORDER_TAG = "order_strategy";

	public function isOrdarable(string $orderType): bool;
	public function sendOrder(): void;
}