<?php

namespace App\Entity\Products;

use App\Entity\Interfaces\OrderStrategyInterface;
use App\Entity\Order;
use App\Repository\FlowersRepository;
use App\Service\Serializer\SerializerService;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * @ORM\Entity(repositoryClass=FlowersRepository::class)
 */
class Flowers implements OrderStrategyInterface
{
    private const TYPE = "flowers";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="simple_array")
     */
    private array $address = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $deliver_on;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, cascade={"persist", "remove"})
     */
    private $orderEntity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?array
    {
        return $this->address;
    }

    public function setAddress(array $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDeliverOn(): ?\DateTimeInterface
    {
        return $this->deliver_on;
    }

    public function setDeliverOn(\DateTimeInterface $deliver_on): self
    {
        $this->deliver_on = $deliver_on;

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
        return self::TYPE === $orderType;
    }

    /**
     * @param object            $flowers
     * @param string            $sendType
     * @param SerializerService $serializerService
     *
     * @return array|bool|float|int|mixed|string
     * @throws ExceptionInterface
     *
     * STRATEGY PATTERN, after is isOrderable() is true, handle the sending logic
     * on which format to send (json or xml) and to serialize accordingly.
     */
    public function sendOrder(object $flowers, string $sendType, SerializerService $serializerService)
    {
        if ($sendType == 'JSON') {
            $sendableData = $this->handleData($flowers);

            return $serializerService->serializeWithRelationsToJson($sendableData);
        } elseif ($sendType == 'XML') {
            $sendableData = $this->handleData($flowers);

            return $serializerService->serializeWithRelationsToXml($sendableData);
        } else {
            return false;
        }
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

    private function handleData(Flowers $flowers)
    {
        return [
            'orderId' => $flowers->getOrderEntity()->getId(),
            'delivery_place ' => implode(', ', $flowers->getAddress()),
            'name' => $flowers->getOrderEntity()->getProductName(),
            'deliver_at' => $flowers->getDeliverOn()->format('Y-m-d H:m:s'),
        ];
    }
}
