<?php

namespace App\Repository;

use App\Entity\Products\ProductComponents\CupSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CupSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method CupSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method CupSize[]    findAll()
 * @method CupSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CupSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CupSize::class);
    }
}
