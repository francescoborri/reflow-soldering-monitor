<?php

namespace App\Repository;

use App\Entity\SolderedPrintedCircuitBoard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SolderedPrintedCircuitBoard|null find($id, $lockMode = null, $lockVersion = null)
 * @method SolderedPrintedCircuitBoard|null findOneBy(array $criteria, array $orderBy = null)
 * @method SolderedPrintedCircuitBoard[]    findAll()
 * @method SolderedPrintedCircuitBoard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolderedPrintedCircuitBoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SolderedPrintedCircuitBoard::class);
    }
}
