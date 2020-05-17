<?php

namespace App\Entity;

use App\Entity\Interfaces\OrderStrategyInterface;
use App\Entity\Traits\WithCreatedAt;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    use WithCreatedAt;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;
    private array $strategies = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orderAccepted = false;

    public function addStrategy(OrderStrategyInterface $orderStrategy): void
    {
        $this->strategies[] = $orderStrategy;
    }

    public function handleOrder($orderObject)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->isOrderable('coffee')) {
                return $strategy->sendOrder($orderObject);
            }
        }
        throw new \InvalidArgumentException('This type of order is not orderable');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getOrderAccepted(): ?bool
    {
        return $this->orderAccepted;
    }

    public function setOrderAccepted(bool $orderAccepted): self
    {
        $this->orderAccepted = $orderAccepted;

        return $this;
    }
}
