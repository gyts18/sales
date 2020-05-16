<?php

namespace App\Entity;

use App\Repository\FlowersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlowersRepository::class)
 */
class Flowers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $address = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $deliver_on;

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
}
