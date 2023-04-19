<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 * 
 */
#[ORM\Table(name: 'category')]
#[ORM\Entity(repositoryClass: 'App\Repository\CategoryRepository')]
class Category
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
    #[ORM\Column(name: 'name_category', type: 'string', length: 45, nullable: false)]
    private $nameCategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     */
    #[ORM\ManyToMany(targetEntity: 'Product', mappedBy: 'category')]
    private $product = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): self
    {
        $this->nameCategory = $nameCategory;

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
            $product->addCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->removeElement($product)) {
            $product->removeCategory($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nameCategory;
    }

}
