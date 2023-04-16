<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository") 
 */
class Product
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
     * @ORM\Column(name="name_product", type="string", length=45, nullable=false)
     */
    private $nameProduct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_product", type="string", length=200, nullable=true)
     */
    private $descriptionProduct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_product", type="string", length=45, nullable=true)
     */
    private $imageProduct;

    /**
     * @var float
     *
     * @ORM\Column(name="price_product", type="float", precision=6, scale=2, nullable=false)
     */
    private $priceProduct;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantity_product", type="integer", nullable=true)
     */
    private $quantityProduct;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="product")
     * @ORM\JoinTable(name="product_category",
     *   joinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *   }
     * )
     */
    private $category = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="SuppliedItem", inversedBy="product")
     * @ORM\JoinTable(name="product_composition",
     *   joinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="id")
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
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->suppliedItem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProduct(): ?string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): self
    {
        $this->nameProduct = $nameProduct;

        return $this;
    }

    public function getDescriptionProduct(): ?string
    {
        return $this->descriptionProduct;
    }

    public function setDescriptionProduct(?string $descriptionProduct): self
    {
        $this->descriptionProduct = $descriptionProduct;

        return $this;
    }

    public function getImageProduct(): ?string
    {
        return $this->imageProduct;
    }

    public function setImageProduct(?string $imageProduct): self
    {
        $this->imageProduct = $imageProduct;

        return $this;
    }

    public function getPriceProduct(): ?float
    {
        return $this->priceProduct;
    }

    public function setPriceProduct(float $priceProduct): self
    {
        $this->priceProduct = $priceProduct;

        return $this;
    }

    public function getQuantityProduct(): ?int
    {
        return $this->quantityProduct;
    }

    public function setQuantityProduct(?int $quantityProduct): self
    {
        $this->quantityProduct = $quantityProduct;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

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

    public function __toString()
    {
        return $this->nameProduct;
    }
}
