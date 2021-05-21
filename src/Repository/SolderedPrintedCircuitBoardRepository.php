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

    // /**
    //  * @return SolderedPrintedCircuitBoard[] Returns an array of SolderedPrintedCircuitBoard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SolderedPrintedCircuitBoard
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
