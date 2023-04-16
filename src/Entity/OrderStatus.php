<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderStatus
 *
 * @ORM\Table(name="order_status")
 * @ORM\Entity(repositoryClass="App\Repository\OrderStatusRepository") 
 */
class OrderStatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name_order_status", type="string", length=45, nullable=false)
     */
    private $nameOrderStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOrderStatus(): ?string
    {
        return $this->nameOrderStatus;
    }

    public function setNameOrderStatus(string $nameOrderStatus): self
    {
        $this->nameOrderStatus = $nameOrderStatus;

        return $this;
    }

    public function __toString()
    {
        return $this->nameOrderStatus;
    }


}
