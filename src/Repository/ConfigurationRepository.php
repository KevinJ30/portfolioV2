<?php

namespace App\Repository;

use App\Entity\Configuration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Configuration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Configuration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Configuration[]    findAll()
 * @method Configuration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Configuration::class);
    }

    /**
     * Retourne la liste des configurations de la page d'accueil
     *
     * @return array<mixed>
     **/
    public function getConfigurationHome() : array {
        return $this->createQueryBuilder('c')
                    ->orWhere('c.name = \'site_title\'')
                    ->orWhere('c.name = \'svg_introduction\'')
                    ->orWhere('c.name = \'introduction\'')
                    ->orderBy('c.name', 'desc')
                    ->getQuery()
                    ->execute();
    }

    /**
     * Retourne la liste des configurations pour la page contact
     *
     * @return array<mixed>
     **/
    public function getConfigurationContact() : array {
        return $this->createQueryBuilder('c')
            ->orWhere('c.name = \'contact_text\'')
            ->getQuery()
            ->execute();
    }
}
