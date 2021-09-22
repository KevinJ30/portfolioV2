<?php

namespace App\DataFixtures;

use App\Entity\Projects;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Données de test de la configuration
 *
 * Class ProjectFixtures
 * @package App\DataFixtures
 **/
class ProjectFixtures extends Fixture
{
    /**
     * Ajoute les données dans la base de données
     *
     * @param ObjectManager $manager
     **/
    public function load(ObjectManager $manager) : void
    {
        for($i = 0; $i <= 10; $i++) {
            $manager->persist($this->createProject());
        }

        $manager->flush();
    }

    /**
     * Créer un project
     *
     * @return Projects
     **/
    private function createProject() : Projects {
        $faker = Factory::create();

        $project = new Projects();
        $project->setTitle($faker->title)
            ->setDescription($faker->text(300))
            ->setUrl($faker->url)
            ->setCreated(new \DateTimeImmutable())
            ->setDetails($faker->jobTitle)
            ->setExcerpt($faker->text(100))
            ->setThumb('http://no-link.fr');

        return $project;
    }
}
