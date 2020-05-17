<?php


namespace App\Factories;


use App\Entity\Order;
use App\Entity\Products\Flowers;

class FlowerFactory
{
    /**
     * @param Order   $order
     * @param Flowers $flowers
     *
     * @return Flowers
     * Create entity
     */
    public function create(Order $order, Flowers $flowers): Flowers
    {
        $order->setProductName('Flowers');
        $order->setDeliverAt($flowers->getDeliverOn());
        $flowers->setOrderEntity($order);
        $order->setCreatedAt();

        return $flowers;
    }
}