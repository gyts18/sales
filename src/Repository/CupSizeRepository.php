<?php

namespace App\Repository;

use App\Entity\CupSize;
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

    // /**
    //  * @return CupSize[] Returns an array of CupSize objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CupSize
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
