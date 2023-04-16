<?php

namespace App\Entity;

use App\Entity\Address;
use Doctrine\ORM\Mapping as ORM;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier", indexes={@ORM\Index(name="fk_supplier_address1_idx", columns={"address_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\SupplierRepository") 
 */
class Supplier
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
     * @ORM\Column(name="name_supplier", type="string", length=45, nullable=false)
     */
    private $nameSupplier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="siret_supplier", type="string", length=45, nullable=true)
     */
    private $siretSupplier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_supplier", type="string", length=12, nullable=true)
     */
    private $phoneSupplier;

    /**
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSupplier(): ?string
    {
        return $this->nameSupplier;
    }

    public function setNameSupplier(string $nameSupplier): self
    {
        $this->nameSupplier = $nameSupplier;

        return $this;
    }

    public function getSiretSupplier(): ?string
    {
        return $this->siretSupplier;
    }

    public function setSiretSupplier(?string $siretSupplier): self
    {
        $this->siretSupplier = $siretSupplier;

        return $this;
    }

    public function getPhoneSupplier(): ?string
    {
        return $this->phoneSupplier;
    }

    public function setPhoneSupplier(?string $phoneSupplier): self
    {
        $this->phoneSupplier = $phoneSupplier;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function __toString()
    {
        return $this->nameSupplier;
    }

}
