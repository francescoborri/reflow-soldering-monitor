<?php

namespace App\Entity;

use App\Repository\PrintedCircuitBoardComponentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrintedCircuitBoardComponentRepository::class)
 */
class PrintedCircuitBoardComponent
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=PrintedCircuitBoard::class, inversedBy="components")
     * @ORM\JoinColumn(nullable=false)
     */
    private $printedCircuitBoard;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Component::class, inversedBy="printedCircuitBoards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $component;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    public function getPrintedCircuitBoard(): ?PrintedCircuitBoard
    {
        return $this->printedCircuitBoard;
    }

    public function setPrintedCircuitBoard(?PrintedCircuitBoard $printedCircuitBoard): self
    {
        $this->printedCircuitBoard = $printedCircuitBoard;

        return $this;
    }

    public function getComponent(): ?Component
    {
        return $this->component;
    }

    public function setComponent(?Component $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
