<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 * @ORM\Table(name="addresses")
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $channelNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $channelName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $postalCode;

    /**
     * @ORM\OneToOne(targetEntity=Version::class, mappedBy="address", cascade={"persist", "remove"})
     */
    private $version;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannelNumber(): ?int
    {
        return $this->channelNumber;
    }

    public function setChannelNumber(int $channelNumber): self
    {
        $this->channelNumber = $channelNumber;

        return $this;
    }

    public function getChannelName(): ?string
    {
        return $this->channelName;
    }

    public function setChannelName(string $channelName): self
    {
        $this->channelName = $channelName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setVersion(Version $version): self
    {
        // set the owning side of the relation if necessary
        if ($version->getAddress() !== $this) {
            $version->setAddress($this);
        }

        $this->version = $version;

        return $this;
    }
}
