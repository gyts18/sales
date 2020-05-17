<?php

namespace App\Entity\Products;

use App\Entity\Interfaces\OrderStrategyInterface;
use App\Entity\Order;
use App\Entity\Products\ProductComponents\CupSize;
use App\Entity\Products\ProductComponents\Milk;
use App\Repository\CoffeeRepository;
use App\Service\Serializer\SerializerService;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * @ORM\Entity(repositoryClass=CoffeeRepository::class)
 */
class Coffee implements OrderStrategyInterface
{
    private const KEY = "coffee";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $milk = false;

    /**
     * @ORM\ManyToOne(targetEntity=Milk::class)
     */
    private ?Milk $milkType = null;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $location = [];

    /**
     * @ORM\ManyToOne(targetEntity=CupSize::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $cupSize;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, cascade={"persist", "remove"})
     */
    private $orderEntity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMilk(): ?bool
    {
        return $this->milk;
    }

    public function setMilk(bool $milk): self
    {
        $this->milk = $milk;

        return $this;
    }

    public function getMilkType(): ?Milk
    {
        return $this->milkType;
    }

    public function setMilkType(?Milk $milkType): self
    {
        $this->milkType = $milkType;

        return $this;
    }

    public function getLocation(): ?array
    {
        return $this->location;
    }

    public function setLocation(array $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @param string $orderType
     *
     * @return bool
     *
     * STRATEGY PATTERN, check if entity is orderable
     */
    public function isOrderable(string $orderType): bool
    {
        return $orderType === SELF::KEY;
    }

    /**
     * @param object            $coffee
     * @param string            $sendType
     * @param SerializerService $serializerService
     *
     * @return array|bool|float|int|mixed|string
     * @throws ExceptionInterface
     *
     * STRATEGY PATTERN, after is isOrderable() is true, handle the sending logic
     * on which format to send (json or xml) and to serialize accordingly.
     */
    public function sendOrder(object $coffee, string $sendType, SerializerService $serializerService)
    {
        if ($sendType == 'JSON') {

            $sendableData = $this->handleData($coffee);

            return $serializerService->serializeWithRelationsToJson($sendableData);
        } elseif ($sendType == 'XML') {
            $sendableData = $this->handleData($coffee);

            return $serializerService->serializeWithRelationsToXml($sendableData);
        } else {
            return false;
        }
    }

    public function getCupSize(): ?CupSize
    {
        return $this->cupSize;
    }

    public function setCupSize(?CupSize $cupSize): self
    {
        $this->cupSize = $cupSize;

        return $this;
    }

    public function getOrderEntity(): ?Order
    {
        return $this->orderEntity;
    }

    public function setOrderEntity(?Order $orderEntity): self
    {
        $this->orderEntity = $orderEntity;

        return $this;
    }

    private function handleData(Coffee $coffee)
    {
        return [
            'orderId' => $coffee->getOrderEntity()->getId(),
            'delivery_place' => [
                'latitude' => $coffee->getLocation()[0],
                'longitude' => $coffee->getLocation()[1],
            ],
            'name' => $coffee->getOrderEntity()->getProductName(),
            'deliver_at' => $coffee->getOrderEntity()->getDeliverAt()->format('Y-m-d H:m:s'),
        ];
    }
}
