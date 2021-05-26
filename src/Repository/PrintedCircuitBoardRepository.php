<?php

namespace App\Repository;

use App\Entity\PrintedCircuitBoard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrintedCircuitBoard|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrintedCircuitBoard|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrintedCircuitBoard[]    findAll()
 * @method PrintedCircuitBoard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrintedCircuitBoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrintedCircuitBoard::class);
    }
}
