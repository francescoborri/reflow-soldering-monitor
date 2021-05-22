<?php

namespace App\Entity;

use App\Repository\PrintedCircuitBoardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=PrintedCircuitBoardRepository::class)
 * @ApiResource()
 */
class PrintedCircuitBoard
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shape;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $cost;

    /**
     * @ORM\OneToMany(targetEntity=SolderedPrintedCircuitBoard::class, mappedBy="printedCircuitBoard")
     */
    private $solderedPrintedCircuitBoards;

    /**
     * @ORM\OneToMany(targetEntity=PrintedCircuitBoardComponent::class, mappedBy="printedCircuitBoard")
     */
    private $components;

    public function __construct()
    {
        $this->solderedPrintedCircuitBoards = new ArrayCollection();
        $this->components = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getShape(): ?string
    {
        return $this->shape;
    }

    public function setShape(string $shape): self
    {
        $this->shape = $shape;

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

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

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
            $solderedPrintedCircuitBoard->setPrintedCircuitBoard($this);
        }

        return $this;
    }

    public function removeSolderedPrintedCircuitBoard(SolderedPrintedCircuitBoard $solderedPrintedCircuitBoard): self
    {
        if ($this->solderedPrintedCircuitBoards->removeElement($solderedPrintedCircuitBoard)) {
            // set the owning side to null (unless already changed)
            if ($solderedPrintedCircuitBoard->getPrintedCircuitBoard() === $this) {
                $solderedPrintedCircuitBoard->setPrintedCircuitBoard(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrintedCircuitBoardComponent[]
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(PrintedCircuitBoardComponent $component): self
    {
        if (!$this->components->contains($component)) {
            $this->components[] = $component;
            $component->setPrintedCircuitBoard($this);
        }

        return $this;
    }

    public function removeComponent(PrintedCircuitBoardComponent $component): self
    {
        if ($this->components->removeElement($component)) {
            // set the owning side to null (unless already changed)
            if ($component->getPrintedCircuitBoard() === $this) {
                $component->setPrintedCircuitBoard(null);
            }
        }

        return $this;
    }
}
