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

    // /**
    //  * @return PrintedCircuitBoardComponent[] Returns an array of PrintedCircuitBoardComponent objects
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
    public function findOneBySomeField($value): ?PrintedCircuitBoardComponent
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
