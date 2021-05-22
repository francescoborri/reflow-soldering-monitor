<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Component;
use App\Entity\Measurement;
use App\Entity\Office;
use App\Entity\PrintedCircuitBoard;
use App\Entity\PrintedCircuitBoardComponent;
use App\Entity\ProductionZone;
use App\Entity\ReflowSolderingOven;
use App\Entity\SolderedPrintedCircuitBoard;
use App\Entity\Staff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $branch = new Branch();
        $branch->setName('Headquarters');
        $branch->setAddress('Via Roma 1');
        $branch->setCity('Arezzo');
        $branch->setPostalCode('52100');
        $manager->persist($branch);

        $office = new Office();
        $office->setFloor(1);
        $office->setRoom(1);
        $office->setBranch($branch);
        $manager->persist($office);

        $productionZone = new ProductionZone();
        $productionZone->setFloor(1);
        $productionZone->setRoom(2);
        $productionZone->setBranch($branch);
        $manager->persist($productionZone);

        $technician = new Staff();
        $technician->setFiscalCode('BRRFNC02L23A390H');
        $technician->setPassword($this->encoder->encodePassword($technician, '1234'));
        $technician->setName('Francesco');
        $technician->setSurname('Borri');
        $technician->setEmail('francesco.borri02@gmail.com');
        $technician->setPhone('3334446655');
        $technician->setBirthDate(new \DateTime('2002-07-23'));
        $technician->setAddress('Via Roma 2');
        $technician->setPostalCode('52100');
        $technician->setPosition('IT techinician');
        $technician->setSalary(2000.89);
        $technician->setOffice($office);
        $manager->persist($technician);

        $labourer = new Staff();
        $labourer->setFiscalCode('AAABBB90A05A390N');
        $labourer->setPassword($this->encoder->encodePassword($labourer, '1234'));
        $labourer->setName('Mario');
        $labourer->setSurname('Rossi');
        $labourer->setEmail('mario.rossi@gmail.com');
        $labourer->setPhone('3334445566');
        $labourer->setBirthDate(new \DateTime('1990-01-05'));
        $labourer->setAddress('Via Roma 3');
        $labourer->setPostalCode('52100');
        $labourer->setPosition('Labourer');
        $labourer->setSalary(1500.51);
        $labourer->setProductionZone($productionZone);
        $manager->persist($labourer);

        $printedCircuitBoard = new PrintedCircuitBoard();
        $printedCircuitBoard->setName('Standard PCB');
        $printedCircuitBoard->setShape('Standard');
        $printedCircuitBoard->setCost(100.55);
        $manager->persist($printedCircuitBoard);

        $reflowSolderingOven = new ReflowSolderingOven();
        $reflowSolderingOven->setModel('Reflow Soldering Oven');
        $reflowSolderingOven->setBrand('Panasonic');
        $reflowSolderingOven->setPreheatPhaseDuration(75);
        $reflowSolderingOven->setReflowPhaseDuration(50.5);
        $reflowSolderingOven->setCoolingPhaseDuration(5);
        $reflowSolderingOven->setPreheatPhaseMax(130);
        $reflowSolderingOven->setPreheatPhaseMin(170);
        $reflowSolderingOven->setReflowPhaseMax(218);
        $reflowSolderingOven->setReflowPhaseMin(217);
        $reflowSolderingOven->setCoolingPhaseMax(217);
        $reflowSolderingOven->setCoolingPhaseMin(0);
        $reflowSolderingOven->setProductionZone($productionZone);
        $reflowSolderingOven->setManager($labourer);
        $manager->persist($reflowSolderingOven);

        for ($i = 0; $i < 10; $i++) {
            $component = new Component();
            $component->setName("Component $i");
            $component->setCost($i * 10.5);
            $manager->persist($component);

            $relation = new PrintedCircuitBoardComponent();
            $relation->setAmount($i);
            $relation->setComponent($component);
            $relation->setPrintedCircuitBoard($printedCircuitBoard);
            $manager->persist($relation);
        }

        for ($i = 0; $i < 10; $i++) {
            $now = new \DateTime('now');
            $end = clone($now);
            $end->add(new \DateInterval('PT140S'));

            $solderedPrintedCircuitBoard = new SolderedPrintedCircuitBoard();
            $solderedPrintedCircuitBoard->setSerialNumber("S$i");
            $solderedPrintedCircuitBoard->setPrintedCircuitBoard($printedCircuitBoard);
            $solderedPrintedCircuitBoard->setReflowSolderingOven($reflowSolderingOven);
            $solderedPrintedCircuitBoard->setEntryDatetime($now);
            $solderedPrintedCircuitBoard->setExitDatetime($end);
            $manager->persist($solderedPrintedCircuitBoard);
        }

        for ($j = 0; $j < 1000; $j++) {
            $datetime = clone($now);
            $datetime->add(new \DateInterval("PT{$i}S"));

            $measurement = new Measurement();
            $measurement->setTemperature(mt_rand(0, 230));
            $measurement->setDatetime($datetime);
            $measurement->setReflowSolderingOven($reflowSolderingOven);
            $manager->persist($measurement);
        }

        $manager->flush();
    }
}
