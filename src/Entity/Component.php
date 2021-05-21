<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComponentRepository::class)
 */
class Component
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $cost;

    /**
     * @ORM\OneToMany(targetEntity=PrintedCircuitBoardComponent::class, mappedBy="component")
     */
    private $printedCircuitBoards;

    public function __construct()
    {
        $this->printedCircuitBoards = new ArrayCollection();
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
     * @return Collection|PrintedCircuitBoardComponent[]
     */
    public function getPrintedCircuitBoards(): Collection
    {
        return $this->printedCircuitBoards;
    }

    public function addPrintedCircuitBoard(PrintedCircuitBoardComponent $printedCircuitBoard): self
    {
        if (!$this->printedCircuitBoards->contains($printedCircuitBoard)) {
            $this->printedCircuitBoards[] = $printedCircuitBoard;
            $printedCircuitBoard->setComponent($this);
        }

        return $this;
    }

    public function removePrintedCircuitBoard(PrintedCircuitBoardComponent $printedCircuitBoard): self
    {
        if ($this->printedCircuitBoards->removeElement($printedCircuitBoard)) {
            // set the owning side to null (unless already changed)
            if ($printedCircuitBoard->getComponent() === $this) {
                $printedCircuitBoard->setComponent(null);
            }
        }

        return $this;
    }
}
