<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Component;
use App\Entity\Office;
use App\Entity\PrintedCircuitBoard;
use App\Entity\PrintedCircuitBoardComponent;
use App\Entity\ProductionZone;
use App\Entity\ReflowSolderingOven;
use App\Entity\Staff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager)
    {
        $this->encoder = $encoder;

        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager)
    {
        $this->entityManager->getConnection()->executeQuery('ALTER TABLE branch AUTO_INCREMENT = 1;');
        $this->entityManager->getConnection()->executeQuery('ALTER TABLE component AUTO_INCREMENT = 1;');
        $this->entityManager->getConnection()->executeQuery('ALTER TABLE measurement AUTO_INCREMENT = 1;');
        $this->entityManager->getConnection()->executeQuery('ALTER TABLE office AUTO_INCREMENT = 1;');
        $this->entityManager->getConnection()->executeQuery('ALTER TABLE printed_circuit_board AUTO_INCREMENT = 1;');
        $this->entityManager->getConnection()->executeQuery('ALTER TABLE production_zone AUTO_INCREMENT = 1;');
        $this->entityManager->getConnection()->executeQuery('ALTER TABLE reflow_soldering_oven AUTO_INCREMENT = 1;');

        $branch = new Branch();
        $branch->setName('Headquarters');
        $branch->setAddress('Via Roma 1');
        $branch->setPostalCode('52100');
        $branch->setDescription('Headquarters');
        $manager->persist($branch);

        $office = new Office();
        $office->setFloor(1);
        $office->setRoom(1);
        $office->setBranch($branch);
        $office->setDescription('CEO office');
        $manager->persist($office);

        $productionZone = new ProductionZone();
        $productionZone->setFloor(1);
        $productionZone->setRoom(2);
        $productionZone->setBranch($branch);
        $productionZone->setDescription('Reflow soldering zone');
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
        $technician->setSalary(2000);
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
        $labourer->setSalary(1500);
        $labourer->setProductionZone($productionZone);
        $manager->persist($labourer);

        $reflowSolderingOven = new ReflowSolderingOven();
        $reflowSolderingOven->setModel('Reflow Soldering Oven');
        $reflowSolderingOven->setBrand('Panasonic');
        $reflowSolderingOven->setPreheatPhaseDuration(20);
        $reflowSolderingOven->setReflowPhaseDuration(20);
        $reflowSolderingOven->setCoolingPhaseDuration(20);
        $reflowSolderingOven->setPreheatPhaseMax(170);
        $reflowSolderingOven->setPreheatPhaseMin(130);
        $reflowSolderingOven->setReflowPhaseMax(218);
        $reflowSolderingOven->setReflowPhaseMin(210);
        $reflowSolderingOven->setCoolingPhaseMax(217);
        $reflowSolderingOven->setCoolingPhaseMin(0);
        $reflowSolderingOven->setProductionZone($productionZone);
        $reflowSolderingOven->setManager($labourer);
        $manager->persist($reflowSolderingOven);

        $components = [];

        for ($i = 0; $i < 10; $i++) {
            $component = new Component();
            $component->setName("Component $i");
            $component->setCost(mt_rand(1, 10));
            $manager->persist($component);
            $components[] = $component;
        }

        for ($i = 0; $i < 10; $i++) {
            $printedCircuitBoard = new PrintedCircuitBoard();
            $printedCircuitBoard->setName("Standard PCB Model $i");
            $printedCircuitBoard->setShape('Standard');
            $printedCircuitBoard->setCost(10.45);
            $manager->persist($printedCircuitBoard);

            $notSelectedComponents = $components;

            for ($i = 0; $i < mt_rand(0, count($components) - 1); $i++) {
                $index = array_rand($notSelectedComponents);
                $component = $notSelectedComponents[$index];
                unset($notSelectedComponents[$index]);

                $relation = new PrintedCircuitBoardComponent();
                $relation->setAmount(mt_rand(0, 10));
                $relation->setComponent($component);
                $relation->setPrintedCircuitBoard($printedCircuitBoard);
                $manager->persist($relation);
            }
        }

        $manager->flush();
    }
}
