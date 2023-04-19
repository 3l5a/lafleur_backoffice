<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SuppliedItem
 * 
 */
#[ORM\Table(name: 'supplied_item')]
#[ORM\Index(name: 'fk_supplied_item_measurement1_idx', columns: ['measurement_id'])]
#[ORM\Index(name: 'fk_supplied_item_color1_idx', columns: ['color_id'])]
#[ORM\Entity(repositoryClass: 'App\Repository\SuppliedItemRepository')]
class SuppliedItem
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
    #[ORM\Column(name: 'name_supplied_item', type: 'string', length: 45, nullable: false)]
    private $nameSuppliedItem;

    /**
     * @var string|null
     *
     */
    #[ORM\Column(name: 'description_supplied_item', type: 'string', length: 100, nullable: true)]
    private $descriptionSuppliedItem;

    /**
     * @var float|null
     *
     */
    #[ORM\Column(name: 'price_supplied_item', type: 'float', precision: 6, scale: 2, nullable: true)]
    private $priceSuppliedItem;

    /**
     * @var \Color
     *
     */
    #[ORM\JoinColumn(name: 'color_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Color')]
    private $color;

    /**
     * @var \Measurement
     *
     */
    #[ORM\JoinColumn(name: 'measurement_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: 'Measurement')]
    private $measurement;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     */
    #[ORM\ManyToMany(targetEntity: 'SupplierOrder', mappedBy: 'suppliedItem')]
    private $supplierOrder = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     */
    #[ORM\ManyToMany(targetEntity: 'Product', mappedBy: 'suppliedItem')]
    private $product = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->supplierOrder = new \Doctrine\Common\Collections\ArrayCollection();
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSuppliedItem(): ?string
    {
        return $this->nameSuppliedItem;
    }

    public function setNameSuppliedItem(string $nameSuppliedItem): self
    {
        $this->nameSuppliedItem = $nameSuppliedItem;

        return $this;
    }

    public function getDescriptionSuppliedItem(): ?string
    {
        return $this->descriptionSuppliedItem;
    }

    public function setDescriptionSuppliedItem(?string $descriptionSuppliedItem): self
    {
        $this->descriptionSuppliedItem = $descriptionSuppliedItem;

        return $this;
    }

    public function getPriceSuppliedItem(): ?float
    {
        return $this->priceSuppliedItem;
    }

    public function setPriceSuppliedItem(?float $priceSuppliedItem): self
    {
        $this->priceSuppliedItem = $priceSuppliedItem;

        return $this;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMeasurement(): ?Measurement
    {
        return $this->measurement;
    }

    public function setMeasurement(?Measurement $measurement): self
    {
        $this->measurement = $measurement;

        return $this;
    }

    /**
     * @return Collection<int, SupplierOrder>
     */
    public function getSupplierOrder(): Collection
    {
        return $this->supplierOrder;
    }

    public function addSupplierOrder(SupplierOrder $supplierOrder): self
    {
        if (!$this->supplierOrder->contains($supplierOrder)) {
            $this->supplierOrder->add($supplierOrder);
            $supplierOrder->addSuppliedItem($this);
        }

        return $this;
    }

    public function removeSupplierOrder(SupplierOrder $supplierOrder): self
    {
        if ($this->supplierOrder->removeElement($supplierOrder)) {
            $supplierOrder->removeSuppliedItem($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
            $product->addSuppliedItem($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->removeElement($product)) {
            $product->removeSuppliedItem($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nameSuppliedItem;
    }
}
