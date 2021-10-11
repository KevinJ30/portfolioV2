<?php

namespace App\Repository;

use App\Entity\Projects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Projects|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projects|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projects[]    findAll()
 * @method Projects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projects::class);
    }

    /**
     * Retourne la liste des 4 derniers projets
     *
     * @param int $number Nombre de projet
     * @return int|mixed|string
     */
    public function getLastProjects(int $number) {
        return $this->createQueryBuilder('p')
                    ->orderBy('p.created', 'desc')
                    ->setMaxResults($number)
                    ->getQuery()
                    ->execute();
    }

    /**
     * Retourne la requête pour la pagination
     *
     * @return Query
     **/
    public function getQueryPaginate() : Query {
        return $this->createQueryBuilder('p')
                   ->orderBy('p.created', 'desc')
                   ->getQuery();
    }
}
