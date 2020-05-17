<?php


namespace App\Factories;


use App\Entity\Order;
use App\Entity\Products\Coffee;
use Symfony\Component\Form\FormFactoryInterface;

class CoffeeFactory
{
    public function create(Order $order, Coffee $coffee) :Coffee
    {
        if(!$coffee->getMilk())
        {
            $coffee->setMilkType(null);
        }
        $order->setProductName('Coffee');
        $date = new \DateTime('now');
        $date->modify('+30 minutes');
        $order->setDeliverAt($date);
        $coffee->setOrderEntity($order);
        $order->setCreatedAt();

        return $coffee;
    }
}