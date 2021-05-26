<?php

namespace App\Entity;

use App\Repository\BranchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=BranchRepository::class)
 * @ApiResource(
 *      attributes={"security"="is_granted('ROLE_USER')"},
 *      collectionOperations={"get"},
 *      itemOperations={"get"}
 * )
 */
class Branch
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
    private $address;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Office::class, mappedBy="branch")
     */
    private $offices;

    /**
     * @ORM\OneToMany(targetEntity=ProductionZone::class, mappedBy="branch")
     */
    private $productionZones;

    public function __construct()
    {
        $this->offices = new ArrayCollection();
        $this->productionZones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return Collection|Office[]
     */
    public function getOffices(): Collection
    {
        return $this->offices;
    }

    public function addOffice(Office $office): self
    {
        if (!$this->offices->contains($office)) {
            $this->offices[] = $office;
            $office->setBranch($this);
        }

        return $this;
    }

    public function removeOffice(Office $office): self
    {
        if ($this->offices->removeElement($office)) {
            // set the owning side to null (unless already changed)
            if ($office->getBranch() === $this) {
                $office->setBranch(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductionZone[]
     */
    public function getProductionZones(): Collection
    {
        return $this->productionZones;
    }

    public function addProductionZone(ProductionZone $productionZone): self
    {
        if (!$this->productionZones->contains($productionZone)) {
            $this->productionZones[] = $productionZone;
            $productionZone->setBranch($this);
        }

        return $this;
    }

    public function removeProductionZone(ProductionZone $productionZone): self
    {
        if ($this->productionZones->removeElement($productionZone)) {
            // set the owning side to null (unless already changed)
            if ($productionZone->getBranch() === $this) {
                $productionZone->setBranch(null);
            }
        }

        return $this;
    }
}
