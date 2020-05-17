<?php


namespace App\Service;


use App\Entity\Order;
use App\Service\Traits\RepositoryResultsTrait;

class OrderService extends BaseService
{
	use RepositoryResultsTrait;

    public function getEntityClass(): string
    {
       return Order::class;
    }
}