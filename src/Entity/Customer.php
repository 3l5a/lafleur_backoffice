<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer", indexes={@ORM\Index(name="fk_customer_address1_idx", columns={"address_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository") 
 */
class Customer
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
     * @ORM\Column(name="first_name_customer", type="string", length=45, nullable=false)
     */
    private $firstNameCustomer;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name_customer", type="string", length=45, nullable=false)
     */
    private $lastNameCustomer;

    /**
     * @var string
     *
     * @ORM\Column(name="email_customer", type="string", length=100, nullable=false)
     */
    private $emailCustomer;

    /**
     * @var string
     *
     * @ORM\Column(name="password_customer", type="string", length=70, nullable=false)
     */
    private $passwordCustomer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=45, nullable=true)
     */
    private $role;

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

    public function getFirstNameCustomer(): ?string
    {
        return $this->firstNameCustomer;
    }

    public function setFirstNameCustomer(string $firstNameCustomer): self
    {
        $this->firstNameCustomer = $firstNameCustomer;

        return $this;
    }

    public function getLastNameCustomer(): ?string
    {
        return $this->lastNameCustomer;
    }

    public function setLastNameCustomer(string $lastNameCustomer): self
    {
        $this->lastNameCustomer = $lastNameCustomer;

        return $this;
    }

    public function getEmailCustomer(): ?string
    {
        return $this->emailCustomer;
    }

    public function setEmailCustomer(string $emailCustomer): self
    {
        $this->emailCustomer = $emailCustomer;

        return $this;
    }

    public function getPasswordCustomer(): ?string
    {
        return $this->passwordCustomer;
    }

    public function setPasswordCustomer(string $passwordCustomer): self
    {
        $this->passwordCustomer = $passwordCustomer;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

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
        return $this->firstNameCustomer.' '.$this->lastNameCustomer;
    }

}
