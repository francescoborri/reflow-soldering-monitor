<?php

namespace App\Entity;

use App\Repository\ProductionZoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ProductionZoneRepository::class)
 * @Table(
 *      uniqueConstraints={@UniqueConstraint(columns={"floor","room","branch_id"})}
 * )
 * @ApiResource(
 *      attributes={"security"="is_granted('ROLE_USER')"},
 *      collectionOperations={"get"},
 *      itemOperations={"get"}
 * )
 */
class ProductionZone
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
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $room;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity=Branch::class, inversedBy="productionZones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $branch;

    /**
     * @ORM\OneToMany(targetEntity=ReflowSolderingOven::class, mappedBy="productionZone")
     */
    private $reflowSolderingOvens;

    /**
     * @ORM\OneToMany(targetEntity=Staff::class, mappedBy="productionZone")
     */
    private $staff;

    public function __construct()
    {
        $this->reflowSolderingOvens = new ArrayCollection();
        $this->staff = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getRoom(): ?int
    {
        return $this->room;
    }

    public function setRoom(int $room): self
    {
        $this->room = $room;

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

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): self
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * @return Collection|ReflowSolderingOven[]
     */
    public function getReflowSolderingOvens(): Collection
    {
        return $this->reflowSolderingOvens;
    }

    public function addReflowSolderingOven(ReflowSolderingOven $reflowSolderingOven): self
    {
        if (!$this->reflowSolderingOvens->contains($reflowSolderingOven)) {
            $this->reflowSolderingOvens[] = $reflowSolderingOven;
            $reflowSolderingOven->setProductionZone($this);
        }

        return $this;
    }

    public function removeReflowSolderingOven(ReflowSolderingOven $reflowSolderingOven): self
    {
        if ($this->reflowSolderingOvens->removeElement($reflowSolderingOven)) {
            // set the owning side to null (unless already changed)
            if ($reflowSolderingOven->getProductionZone() === $this) {
                $reflowSolderingOven->setProductionZone(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Staff[]
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staff->contains($staff)) {
            $this->staff[] = $staff;
            $staff->setProductionZone($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staff->removeElement($staff)) {
            // set the owning side to null (unless already changed)
            if ($staff->getProductionZone() === $this) {
                $staff->setProductionZone(null);
            }
        }

        return $this;
    }
}
