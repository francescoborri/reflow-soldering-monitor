<?php

namespace App\Repository;

use App\Entity\ReflowSolderingOven;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReflowSolderingOven|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReflowSolderingOven|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReflowSolderingOven[]    findAll()
 * @method ReflowSolderingOven[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReflowSolderingOvenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReflowSolderingOven::class);
    }
}
