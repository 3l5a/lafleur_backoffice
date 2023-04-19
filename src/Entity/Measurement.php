<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Measurement
 * 
 */
#[ORM\Table(name: 'measurement')]
#[ORM\Entity(repositoryClass: 'App\Repository\MeasurementRepository')]
class Measurement
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
    #[ORM\Column(name: 'unit_measurement', type: 'string', length: 45, nullable: false)]
    private $unitMeasurement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitMeasurement(): ?string
    {
        return $this->unitMeasurement;
    }

    public function setUnitMeasurement(string $unitMeasurement): self
    {
        $this->unitMeasurement = $unitMeasurement;

        return $this;
    }

    public function __toString()
    {
        return $this->unitMeasurement;
    }

}
