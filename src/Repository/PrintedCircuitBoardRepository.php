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

    // /**
    //  * @return PrintedCircuitBoard[] Returns an array of PrintedCircuitBoard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrintedCircuitBoard
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
