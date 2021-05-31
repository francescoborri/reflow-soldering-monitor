<?php

namespace App\Repository;

use App\Entity\Measurement;
use App\Entity\ReflowSolderingOven;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Measurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Measurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Measurement[]    findAll()
 * @method Measurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Measurement[]    getByRange(\DateTimeInterface $start, \DateTimeInterface $end)
 */
class MeasurementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Measurement::class);
    }

    public function getByRange(ReflowSolderingOven $reflowSolderingOven, \DateTimeInterface $start, \DateTimeInterface $end)
    {
        return $this->createQueryBuilder('measurement')
            ->andWhere('measurement.reflowSolderingOven = :reflowSolderingOven')
            ->andWhere('measurement.datetime >= :start')
            ->andWhere('measurement.datetime < :end')
            ->setParameter('reflowSolderingOven', $reflowSolderingOven)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }
}
