<?php

namespace App\Entity\Products;

use App\Entity\Interfaces\OrderStrategyInterface;
use App\Entity\Products\ProductComponents\Milk;
use App\Repository\CoffeeRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private bool $milk;

    /**
     * @ORM\ManyToOne(targetEntity=Milk::class)
     */
    private Milk $milkType;

    /**
     * @ORM\Column(type="array")
     */
    private $location = [];

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

    public function setMilkType(Milk $milkType): self
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

	public function isOrderable(string $orderType): bool
	{
		return $orderType === SELF::KEY;
	}

	public function sendOrder(): void
	{
		// TODO: Implement sendOrder() method.
	}
}
