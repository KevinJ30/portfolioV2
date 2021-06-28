<?php

namespace App\Repository;

use App\Entity\Authorize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Authorize|null find($id, $lockMode = null, $lockVersion = null)
 * @method Authorize|null findOneBy(array $criteria, array $orderBy = null)
 * @method Authorize[]    findAll()
 * @method Authorize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Authorize::class);
    }

    // /**
    //  * @return Authorize[] Returns an array of Authorize objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Authorize
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
