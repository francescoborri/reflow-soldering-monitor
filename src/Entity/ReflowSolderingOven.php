<?php

namespace App\Entity;

use App\Repository\ReflowSolderingOvenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReflowSolderingOvenRepository::class)
 */
class ReflowSolderingOven
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
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $preheatPhaseDuration;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $reflowPhaseDuration;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $coolingPhaseDuration;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $preheatPhaseMax;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $preheatPhaseMin;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $reflowPhaseMax;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $reflowPhaseMin;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $coolingPhaseMax;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $coolingPhaseMin;

    /**
     * @ORM\ManyToOne(targetEntity=ProductionZone::class, inversedBy="reflowSolderingOvens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productionZone;

    /**
     * @ORM\OneToMany(targetEntity=Measurement::class, mappedBy="reflowSolderingOven")
     */
    private $measurements;

    /**
     * @ORM\OneToMany(targetEntity=SolderedPrintedCircuitBoard::class, mappedBy="reflowSolderingOven")
     */
    private $solderedPrintedCircuitBoards;

    /**
     * @ORM\ManyToOne(targetEntity=Staff::class, inversedBy="reflowSolderingOvens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manager;

    public function __construct()
    {
        $this->measurements = new ArrayCollection();
        $this->solderedPrintedCircuitBoards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

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

    public function getPreheatPhaseDuration(): ?string
    {
        return $this->preheatPhaseDuration;
    }

    public function setPreheatPhaseDuration(string $preheatPhaseDuration): self
    {
        $this->preheatPhaseDuration = $preheatPhaseDuration;

        return $this;
    }

    public function getReflowPhaseDuration(): ?string
    {
        return $this->reflowPhaseDuration;
    }

    public function setReflowPhaseDuration(string $reflowPhaseDuration): self
    {
        $this->reflowPhaseDuration = $reflowPhaseDuration;

        return $this;
    }

    public function getCoolingPhaseDuration(): ?string
    {
        return $this->coolingPhaseDuration;
    }

    public function setCoolingPhaseDuration(string $coolingPhaseDuration): self
    {
        $this->coolingPhaseDuration = $coolingPhaseDuration;

        return $this;
    }

    public function getPreheatPhaseMax(): ?string
    {
        return $this->preheatPhaseMax;
    }

    public function setPreheatPhaseMax(string $preheatPhaseMax): self
    {
        $this->preheatPhaseMax = $preheatPhaseMax;

        return $this;
    }

    public function getPreheatPhaseMin(): ?string
    {
        return $this->preheatPhaseMin;
    }

    public function setPreheatPhaseMin(string $preheatPhaseMin): self
    {
        $this->preheatPhaseMin = $preheatPhaseMin;

        return $this;
    }

    public function getReflowPhaseMax(): ?string
    {
        return $this->reflowPhaseMax;
    }

    public function setReflowPhaseMax(string $reflowPhaseMax): self
    {
        $this->reflowPhaseMax = $reflowPhaseMax;

        return $this;
    }

    public function getReflowPhaseMin(): ?string
    {
        return $this->reflowPhaseMin;
    }

    public function setReflowPhaseMin(string $reflowPhaseMin): self
    {
        $this->reflowPhaseMin = $reflowPhaseMin;

        return $this;
    }

    public function getCoolingPhaseMax(): ?string
    {
        return $this->coolingPhaseMax;
    }

    public function setCoolingPhaseMax(string $coolingPhaseMax): self
    {
        $this->coolingPhaseMax = $coolingPhaseMax;

        return $this;
    }

    public function getCoolingPhaseMin(): ?string
    {
        return $this->coolingPhaseMin;
    }

    public function setCoolingPhaseMin(string $coolingPhaseMin): self
    {
        $this->coolingPhaseMin = $coolingPhaseMin;

        return $this;
    }

    public function getProductionZone(): ?ProductionZone
    {
        return $this->productionZone;
    }

    public function setProductionZone(?ProductionZone $productionZone): self
    {
        $this->productionZone = $productionZone;

        return $this;
    }

    /**
     * @return Collection|Measurement[]
     */
    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }

    public function addMeasurement(Measurement $measurement): self
    {
        if (!$this->measurements->contains($measurement)) {
            $this->measurements[] = $measurement;
            $measurement->setReflowSolderingOven($this);
        }

        return $this;
    }

    public function removeMeasurement(Measurement $measurement): self
    {
        if ($this->measurements->removeElement($measurement)) {
            // set the owning side to null (unless already changed)
            if ($measurement->getReflowSolderingOven() === $this) {
                $measurement->setReflowSolderingOven(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SolderedPrintedCircuitBoard[]
     */
    public function getSolderedPrintedCircuitBoards(): Collection
    {
        return $this->solderedPrintedCircuitBoards;
    }

    public function addSolderedPrintedCircuitBoard(SolderedPrintedCircuitBoard $solderedPrintedCircuitBoard): self
    {
        if (!$this->solderedPrintedCircuitBoards->contains($solderedPrintedCircuitBoard)) {
            $this->solderedPrintedCircuitBoards[] = $solderedPrintedCircuitBoard;
            $solderedPrintedCircuitBoard->setReflowSolderingOven($this);
        }

        return $this;
    }

    public function removeSolderedPrintedCircuitBoard(SolderedPrintedCircuitBoard $solderedPrintedCircuitBoard): self
    {
        if ($this->solderedPrintedCircuitBoards->removeElement($solderedPrintedCircuitBoard)) {
            // set the owning side to null (unless already changed)
            if ($solderedPrintedCircuitBoard->getReflowSolderingOven() === $this) {
                $solderedPrintedCircuitBoard->setReflowSolderingOven(null);
            }
        }

        return $this;
    }

    public function getManager(): ?Staff
    {
        return $this->manager;
    }

    public function setManager(?Staff $manager): self
    {
        $this->manager = $manager;

        return $this;
    }
}
