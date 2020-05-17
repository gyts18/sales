<?php


namespace App\Service;


use App\Entity\Order;
use App\Entity\Products\Coffee;
use App\Factories\CoffeeFactory;
use App\Service\Serializer\SerializerService;
use App\Service\Traits\RepositoryResultsTrait;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;

class CoffeeService extends BaseService
{
    use RepositoryResultsTrait;

    private CoffeeFactory $coffeeFactory;
    private SerializerService $serializerService;

    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher,
        CoffeeFactory $coffeeFactory,
        SerializerService $serializerService
    ) {
        parent::__construct($em, $dispatcher);
        $this->coffeeFactory = $coffeeFactory;
        $this->serializerService = $serializerService;
    }

    /**
     * @param Order  $order
     * @param Coffee $coffee
     * @param string $type
     * @param string $sendType
     *
     * @return mixed
     * @throws Exception
     *
     * Called from controller to create an entity, and later to handle the order.
     */
    public function createCoffeeAndDispatchOrder(Order $order, Coffee $coffee, string $type, string $sendType)
    {
        $coffee = $this->coffeeFactory->create($order, $coffee);
        $coffee = $this->create($coffee);
        $result = $coffee->getOrderEntity()->handleOrder($coffee, $type, $sendType, $this->serializerService);
        if ($result) {
            return $result;
        }
    }

    public function getEntityClass(): string
    {
        return Coffee::class;
    }
}