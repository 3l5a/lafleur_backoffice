<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository") 
 */
class City
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
     * @ORM\Column(name="name_city", type="string", length=100, nullable=false)
     */
    private $nameCity;

    /**
     * @var int
     *
     * @ORM\Column(name="zip_code_city", type="integer", nullable=false)
     */
    private $zipCodeCity;

    /**
     * @var bool
     *
     * @ORM\Column(name="deliverable", type="boolean", nullable=false)
     */
    private $deliverable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCity(): ?string
    {
        return $this->nameCity;
    }

    public function setNameCity(string $nameCity): self
    {
        $this->nameCity = $nameCity;

        return $this;
    }

    public function getZipCodeCity(): ?int
    {
        return $this->zipCodeCity;
    }

    public function setZipCodeCity(int $zipCodeCity): self
    {
        $this->zipCodeCity = $zipCodeCity;

        return $this;
    }

    public function isDeliverable(): ?bool
    {
        return $this->deliverable;
    }

    public function setDeliverable(bool $deliverable): self
    {
        $this->deliverable = $deliverable;

        return $this;
    }

    public function __toString()
    {
        return $this->nameCity;
    }
}
