<?php

namespace App\Entity;

use App\Repository\SolderedPrintedCircuitBoardRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=SolderedPrintedCircuitBoardRepository::class)
 * @ApiResource()
 */
class SolderedPrintedCircuitBoard
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=ReflowSolderingOven::class, inversedBy="solderedPrintedCircuitBoards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reflowSolderingOven;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=PrintedCircuitBoard::class, inversedBy="solderedPrintedCircuitBoards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $printedCircuitBoard;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $entryDatetime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $exitDatetime;
    
    public function getReflowSolderingOven(): ?ReflowSolderingOven
    {
        return $this->reflowSolderingOven;
    }

    public function setReflowSolderingOven(?ReflowSolderingOven $reflowSolderingOven): self
    {
        $this->reflowSolderingOven = $reflowSolderingOven;

        return $this;
    }

    public function getPrintedCircuitBoard(): ?PrintedCircuitBoard
    {
        return $this->printedCircuitBoard;
    }

    public function setPrintedCircuitBoard(?PrintedCircuitBoard $printedCircuitBoard): self
    {
        $this->printedCircuitBoard = $printedCircuitBoard;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getEntryDatetime(): ?\DateTimeInterface
    {
        return $this->entryDatetime;
    }

    public function setEntryDatetime(\DateTimeInterface $entryDatetime): self
    {
        $this->entryDatetime = $entryDatetime;

        return $this;
    }

    public function getExitDatetime(): ?\DateTimeInterface
    {
        return $this->exitDatetime;
    }

    public function setExitDatetime(\DateTimeInterface $exitDatetime): self
    {
        $this->exitDatetime = $exitDatetime;

        return $this;
    }
}
