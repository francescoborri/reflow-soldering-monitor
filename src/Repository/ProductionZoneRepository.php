<?php

namespace App\Repository;

use App\Entity\ProductionZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductionZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionZone[]    findAll()
 * @method ProductionZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionZoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductionZone::class);
    }
}
