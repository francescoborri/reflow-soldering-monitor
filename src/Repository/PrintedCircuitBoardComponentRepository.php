<?php

namespace App\Repository;

use App\Entity\PrintedCircuitBoardComponent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrintedCircuitBoardComponent|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrintedCircuitBoardComponent|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrintedCircuitBoardComponent[]    findAll()
 * @method PrintedCircuitBoardComponent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrintedCircuitBoardComponentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrintedCircuitBoardComponent::class);
    }
}
