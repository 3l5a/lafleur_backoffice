<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 * 
 * */
#[ORM\Table(name: 'address')]
#[ORM\Index(name: 'fk_address_city_idx', columns: ['city_id'])]
#[ORM\Entity(repositoryClass: 'App\Repository\AddressRepository')]
class Address
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
     * @var string|null
     *
     */
    #[ORM\Column(name: 'line1_adress', type: 'string', length: 45, nullable: true)]
    private $line1Adress;

    /**
     * @var string|null
     *
     */
    #[ORM\Column(name: 'line2_adress', type: 'string', length: 45, nullable: true)]
    private $line2Adress;

    /**
     * @var \City
     *
     */
    #[ORM\JoinColumn(name: 'city_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'City')]
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLine1Adress(): ?string
    {
        return $this->line1Adress;
    }

    public function setLine1Adress(?string $line1Adress): self
    {
        $this->line1Adress = $line1Adress;

        return $this;
    }

    public function getLine2Adress(): ?string
    {
        return $this->line2Adress;
    }

    public function setLine2Adress(?string $line2Adress): self
    {
        $this->line2Adress = $line2Adress;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
