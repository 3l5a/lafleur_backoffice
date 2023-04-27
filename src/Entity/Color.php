<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 * 
 */
#[ORM\Table(name: 'color')]
#[ORM\Entity(repositoryClass: 'App\Repository\ColorRepository')]
class Color
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
    #[ORM\Column(name: 'name_color', type: 'string', length: 45, nullable: false)]
    private $nameColor = "";

    #[ORM\Column(length: 28)]
    private ?string $codeColor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameColor(): ?string
    {
        return $this->nameColor;
    }

    public function setNameColor(string $nameColor): self
    {
        $this->nameColor = $nameColor;

        return $this;
    }

    public function __toString()
    {
        return $this->nameColor;
    }

    public function getCodeColor(): ?string
    {
        return $this->codeColor;
    }

    public function setCodeColor(string $codeColor): self
    {
        $this->codeColor = $codeColor;

        return $this;
    }
}
