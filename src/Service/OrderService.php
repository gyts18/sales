<?php


namespace App\Service;


use App\Entity\Order;
use App\Service\Traits\RepositoryResultsTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class OrderService extends BaseService
{
    use RepositoryResultsTrait;

    /**
     * OrderService constructor.
     *
     * @param EntityManagerInterface   $em
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher
    ) {
        parent::__construct($em, $dispatcher);
    }

    public function getEntityClass(): string
    {
        return Order::class;
    }
}