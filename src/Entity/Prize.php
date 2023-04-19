<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prize
 * 
 */
#[ORM\Table(name: 'prize')]
#[ORM\Entity(repositoryClass: 'App\Repository\PrizeRepository')]
class Prize
{
    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private $id;

    /**
     * @var string
     *
     */
    #[ORM\Column(name: 'name_prize', type: 'string', length: 45, nullable: false)]
    private $namePrize;

    /**
     * @var int
     *
     */
    #[ORM\Column(name: 'quantity_prize', type: 'integer', nullable: false)]
    private $quantityPrize;

    /**
     * @var string|null
     *
     */
    #[ORM\Column(name: 'description_prize', type: 'string', length: 100, nullable: true)]
    private $descriptionPrize;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePrize(): ?string
    {
        return $this->namePrize;
    }

    public function setNamePrize(string $namePrize): self
    {
        $this->namePrize = $namePrize;

        return $this;
    }

    public function getQuantityPrize(): ?int
    {
        return $this->quantityPrize;
    }

    public function setQuantityPrize(int $quantityPrize): self
    {
        $this->quantityPrize = $quantityPrize;

        return $this;
    }

    public function getDescriptionPrize(): ?string
    {
        return $this->descriptionPrize;
    }

    public function setDescriptionPrize(?string $descriptionPrize): self
    {
        $this->descriptionPrize = $descriptionPrize;

        return $this;
    }

    public function __toString()
    {
        return $this->namePrize;
    }


}
