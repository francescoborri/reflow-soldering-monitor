<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\SolderedPrintedCircuitBoardGetController;
use App\Repository\SolderedPrintedCircuitBoardRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Entity(repositoryClass=SolderedPrintedCircuitBoardRepository::class)
 * @ApiResource(
 *      attributes={
 *          "security"="is_granted('ROLE_USER')",
 *          "order"={"exitDatetime": "DESC"}
 *      },
 *      collectionOperations={
 *          "get"={
 *              "controller"=SolderedPrintedCircuitBoardGetController::class,
 *              "normalization_context"={"groups"={"soldered_printed_circuit_board:collection:get"}}
 *          },
 *          "post"={
 *              "denormalization_context"={"groups"={"soldered_printed_circuit_board:collection:post"}}
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "controller"=SolderedPrintedCircuitBoardGetController::class,
 *              "normalization_context"={"groups"={"soldered_printed_circuit_board:item:get"}}
 *          }
 *      }
 * )
 * @ApiFilter(OrderFilter::class, properties={"serialNumber"})
 */
class SolderedPrintedCircuitBoard
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:collection:post","soldered_printed_circuit_board:item:get"})
     */
    private $serialNumber;

    /**
     * @ORM\ManyToOne(targetEntity=ReflowSolderingOven::class, inversedBy="solderedPrintedCircuitBoards")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:collection:post","soldered_printed_circuit_board:item:get"})
     */
    private $reflowSolderingOven;

    /**
     * @ORM\ManyToOne(targetEntity=PrintedCircuitBoard::class, inversedBy="solderedPrintedCircuitBoards")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:collection:post","soldered_printed_circuit_board:item:get"})
     */
    private $printedCircuitBoard;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:collection:post","soldered_printed_circuit_board:item:get"})
     */
    private $entryDatetime;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:collection:post","soldered_printed_circuit_board:item:get"})
     */
    private $exitDatetime;

    /**
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:item:get"})
     */
    private $preheatPhaseOverLimitTemperatures;

    /**
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:item:get"})
     */
    private $reflowPhaseOverLimitTemperatures;

    /**
     * @Groups({"soldered_printed_circuit_board:collection:get","soldered_printed_circuit_board:item:get"})
     */
    private $coolingPhaseOverLimitTemperatures;

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

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

    public function getPreheatPhaseOverLimitTemperatures()
    {
        return $this->preheatPhaseOverLimitTemperatures;
    }

    public function setPreheatPhaseOverLimitTemperatures(int $preheatPhaseOverLimitTemperatures)
    {
        $this->preheatPhaseOverLimitTemperatures = $preheatPhaseOverLimitTemperatures;

        return $this;
    }

    public function getReflowPhaseOverLimitTemperatures()
    {
        return $this->reflowPhaseOverLimitTemperatures;
    }

    public function setReflowPhaseOverLimitTemperatures(int $reflowPhaseOverLimitTemperatures)
    {
        $this->reflowPhaseOverLimitTemperatures = $reflowPhaseOverLimitTemperatures;

        return $this;
    }

    public function getCoolingPhaseOverLimitTemperatures()
    {
        return $this->coolingPhaseOverLimitTemperatures;
    }

    public function setCoolingPhaseOverLimitTemperatures(int $coolingPhaseOverLimitTemperatures)
    {
        $this->coolingPhaseOverLimitTemperatures = $coolingPhaseOverLimitTemperatures;

        return $this;
    }
}
