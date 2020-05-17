<?php

namespace App\Repository;

use App\Entity\Products\Flowers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Flowers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flowers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flowers[]    findAll()
 * @method Flowers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flowers::class);
    }
}
