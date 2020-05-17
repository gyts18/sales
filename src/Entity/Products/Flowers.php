<?php

namespace App\Entity\Products;

use App\Entity\Interfaces\OrderStrategyInterface;
use App\Entity\Order;
use App\Repository\FlowersRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="array")
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

    public function isOrderable(string $orderType): bool
    {
        return self::TYPE === $orderType;
    }

    public function sendOrder(): void
    {
        // TODO: Implement sendOrder() method.
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
}
