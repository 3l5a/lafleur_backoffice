<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * SupplierOrder
 *
 * @ORM\Table(name="supplier_order", indexes={@ORM\Index(name="fk_supplier_order_supplier1_idx", columns={"supplier_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\SupplierOrderRepository") 
 */
class SupplierOrder
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_supplier_order", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateSupplierOrder = 'CURRENT_TIMESTAMP';

    /**
     * @var \Supplier
     *
     * @ORM\ManyToOne(targetEntity="Supplier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     * })
     */
    private $supplier;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="SuppliedItem", inversedBy="supplierOrder")
     * @ORM\JoinTable(name="line_supplier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="supplier_order_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="supplied_item_id", referencedColumnName="id")
     *   }
     * )
     */
    private $suppliedItem = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->suppliedItem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSupplierOrder(): ?\DateTimeInterface
    {
        return $this->dateSupplierOrder;
    }

    public function setDateSupplierOrder(\DateTimeInterface $dateSupplierOrder): self
    {
        $this->dateSupplierOrder = $dateSupplierOrder;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * @return Collection<int, SuppliedItem>
     */
    public function getSuppliedItem(): Collection
    {
        return $this->suppliedItem;
    }

    public function addSuppliedItem(SuppliedItem $suppliedItem): self
    {
        if (!$this->suppliedItem->contains($suppliedItem)) {
            $this->suppliedItem->add($suppliedItem);
        }

        return $this;
    }

    public function removeSuppliedItem(SuppliedItem $suppliedItem): self
    {
        $this->suppliedItem->removeElement($suppliedItem);

        return $this;
    }

}
