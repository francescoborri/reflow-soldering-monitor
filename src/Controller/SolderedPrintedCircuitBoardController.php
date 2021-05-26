<?php

namespace App\Controller;

use App\Entity\SolderedPrintedCircuitBoard;
use App\Repository\MeasurementRepository;
use App\Repository\ReflowSolderingOvenRepository;
use App\Repository\SolderedPrintedCircuitBoardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetSolderedPrintedCircuitBoardController extends AbstractController
{
    private $reflowSolderingOvenRepository;

    private $solderedPrintedCircuitBoardRepository;

    private $measurementRepository;

    public function __construct(ReflowSolderingOvenRepository $reflowSolderingOvenRepository, SolderedPrintedCircuitBoardRepository $solderedPrintedCircuitBoardRepository, MeasurementRepository $measurementRepository)
    {
        $this->reflowSolderingOvenRepository = $reflowSolderingOvenRepository;
        
        $this->solderedPrintedCircuitBoardRepository = $solderedPrintedCircuitBoardRepository;

        $this->measurementRepository = $measurementRepository;
    }

    public function __invoke(SolderedPrintedCircuitBoard $solderedPrintedCircuitBoard)
    {
        $solderedPrintedCircuitBoardMeasurements = $this->measurementRepository->getByRange(
            $solderedPrintedCircuitBoard->getEntryDatetime(),
            $solderedPrintedCircuitBoard->getExitDatetime()
        );

        $reflowSolderingOven = $solderedPrintedCircuitBoard->getReflowSolderingOven();

        $preheatPhaseSuccess = true;
        $reflowPhaseSuccess = true;
        $coolingPhaseSuccess = true;

        $preheatPhaseEnd = clone new \DateTime($solderedPrintedCircuitBoard->getEntryDatetime());
        $preheatPhaseEnd->add(new \DateInterval("PT{$reflowSolderingOven->getPreheatPhaseDuration()}S"));

        $reflowPhaseEnd = clone $preheatPhaseEnd;
        $reflowPhaseEnd->add(new \DateInterval("PT{$reflowSolderingOven->getReflowPhaseDuration()}S"));

        $coolingPhaseEnd = clone $reflowPhaseEnd;
        $coolingPhaseEnd->add(new \DateInterval("PT{$reflowSolderingOven->getCoolingPhaseDuration()}S"));

        $lastIndex = 0;
        
        for ($i = $lastIndex; $i < count($solderedPrintedCircuitBoardMeasurements); $i++) {
            $measurement = $solderedPrintedCircuitBoardMeasurements[$i];

            if ($measurement->getDatetime() >= $preheatPhaseEnd) {
                $lastIndex = $i;
                break;
            }

            if ($measurement->getTemperature() > $reflowSolderingOven->getPreheatPhaseMax() || $measurement->getTemperature() < $reflowSolderingOven->getPreheatPhaseMin()) {

            }
        }
    }
}
