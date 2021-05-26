<?php

namespace App\Controller;

use App\Entity\SolderedPrintedCircuitBoard;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SolderedPrintedCircuitBoardGetController extends AbstractController
{
    private $measurementRepository;

    public function __construct(MeasurementRepository $measurementRepository)
    {
        $this->measurementRepository = $measurementRepository;
    }

    public function __invoke($data)
    {
        $result = [];

        if (is_iterable($data)) foreach ($data as $datum)
            $result[] = $this->operation($datum);
        else
            $result = $this->operation($data);

        return $result;
    }

    public function operation(SolderedPrintedCircuitBoard $data): SolderedPrintedCircuitBoard
    {
        $solderedPrintedCircuitBoardMeasurements = $this->measurementRepository->getByRange(
            $data->getEntryDatetime(),
            $data->getExitDatetime()
        );

        $reflowSolderingOven = $data->getReflowSolderingOven();

        $preheatPhaseOverLimitTemperatures = 0;
        $reflowPhaseOverLimitTemperatures = 0;
        $coolingPhaseOverLimitTemperatures = 0;

        $preheatPhaseEnd = clone $data->getEntryDatetime();
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
                $preheatPhaseOverLimitTemperatures++;
            }
        }

        for ($i = $lastIndex; $i < count($solderedPrintedCircuitBoardMeasurements); $i++) {
            $measurement = $solderedPrintedCircuitBoardMeasurements[$i];

            if ($measurement->getDatetime() >= $reflowPhaseEnd) {
                $lastIndex = $i;
                break;
            }

            if ($measurement->getTemperature() > $reflowSolderingOven->getReflowPhaseMax() || $measurement->getTemperature() < $reflowSolderingOven->getReflowPhaseMin()) {
                $reflowPhaseOverLimitTemperatures++;
            }
        }

        for ($i = $lastIndex; $i < count($solderedPrintedCircuitBoardMeasurements); $i++) {
            $measurement = $solderedPrintedCircuitBoardMeasurements[$i];

            if ($measurement->getDatetime() >= $preheatPhaseEnd) {
                $lastIndex = $i;
                break;
            }

            if ($measurement->getTemperature() > $reflowSolderingOven->getCoolingPhaseMax() || $measurement->getTemperature() < $reflowSolderingOven->getCoolingPhaseMin()) {
                $coolingPhaseOverLimitTemperatures++;
            }
        }

        $data->setPreheatPhaseOverLimitTemperatures($preheatPhaseOverLimitTemperatures);
        $data->setReflowPhaseOverLimitTemperatures($reflowPhaseOverLimitTemperatures);
        $data->setCoolingPhaseOverLimitTemperatures($coolingPhaseOverLimitTemperatures);

        return $data;
    }
}
