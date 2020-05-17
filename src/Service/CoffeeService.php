<?php


namespace App\Service;


use App\Entity\Order;
use App\Entity\Products\Coffee;
use App\Factories\CoffeeFactory;
use App\Service\Traits\RepositoryResultsTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;

class CoffeeService extends BaseService
{
    use RepositoryResultsTrait;
    private CoffeeFactory $coffeeFactory;

    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $dispatcher, CoffeeFactory $coffeeFactory)
    {
        parent::__construct($em, $dispatcher);
        $this->coffeeFactory = $coffeeFactory;
    }

    public function createCoffeeAndDispatchOrder(Order $order, Coffee $coffee, string $type)
    {
        $coffee = $this->coffeeFactory->create($order,$coffee);
        $coffee = $this->create($coffee);
        $coffee->getOrderEntity()->handleOrder($coffee, $type);
    }
    public function getEntityClass(): string
    {
        return Coffee::class;
    }
}