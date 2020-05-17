<?php


namespace App\Service;


use App\Entity\Order;
use App\Entity\Products\Coffee;
use App\Entity\Products\Flowers;
use App\Factories\CoffeeFactory;
use App\Factories\FlowerFactory;
use App\Service\Serializer\SerializerService;
use App\Service\Traits\RepositoryResultsTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class FlowerService extends BaseService
{
    use RepositoryResultsTrait;

    private FlowerFactory $flowerFactory;
    private SerializerService $serializerService;

    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher,
        FlowerFactory $flowerFactory,
        SerializerService $serializerService
    ) {
        parent::__construct($em, $dispatcher);
        $this->flowerFactory = $flowerFactory;
        $this->serializerService = $serializerService;
    }

    public function createFlowersAndDispatchOrder(Order $order, Flowers $flowers, string $type, string $sendType)
    {
        $flowers = $this->flowerFactory->create($order, $flowers);
        $flowers = $this->create($flowers);
        $result = $flowers->getOrderEntity()->handleOrder($flowers, $type, $sendType, $this->serializerService);
        if ($result) {
            return $result;
        }
    }

    public function getEntityClass(): string
    {
        return Flowers::class;
    }
}