<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 * @ORM\Table(name="companies")
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siren;

    /**
     * @ORM\OneToMany(targetEntity=Version::class, mappedBy="company", orphanRemoval=true)
     */
    private $versions;

    /**
     * @ORM\ManyToOne(targetEntity=LegalForm::class, inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $legalForm;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="company")
     */
    private $addresses;

    public function __construct()
    {
        $this->versions = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * @return Collection|Version[]
     */
    public function getVersions(): Collection
    {
        return $this->versions;
    }

    public function addVersion(Version $version): self
    {
        if (!$this->versions->contains($version)) {
            $this->versions[] = $version;
            $version->setCompany($this);
        }

        return $this;
    }

    public function removeVersion(Version $version): self
    {
        if ($this->versions->removeElement($version)) {
            // set the owning side to null (unless already changed)
            if ($version->getCompany() === $this) {
                $version->setCompany(null);
            }
        }

        return $this;
    }

    public function getLegalForm(): ?LegalForm
    {
        return $this->legalForm;
    }

    public function setLegalForm(?LegalForm $legalForm): self
    {
        $this->legalForm = $legalForm;

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCompany($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCompany() === $this) {
                $address->setCompany(null);
            }
        }

        return $this;
    }
}
