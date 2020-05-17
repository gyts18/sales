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
use Exception;
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

    /**
     * @param Order   $order
     * @param Flowers $flowers
     * @param string  $type
     * @param string  $sendType
     *
     * @return mixed
     * @throws Exception
     *
     *  Called from controller to create an entity, and later to handle the order.
     */
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