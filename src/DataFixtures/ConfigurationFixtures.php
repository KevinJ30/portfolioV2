<?php

namespace App\DataFixtures;

use App\Entity\Configuration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Données de test de la configuration
 *
 * Class ConfigurationFixtures
 * @package App\DataFixtures
 **/
class ConfigurationFixtures extends Fixture
{
    /**
     * Ajoute les données dans la base de données
     *
     * @param ObjectManager $manager
     **/
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createSiteTitle());
        $manager->persist($this->createIntroduction());
        $manager->persist($this->createSVG());
        $manager->flush();
    }

    /**
     * Création d'un élément dans la configuration
     *
     * @param string $name Nom du paramètre
     * @param string $content Contenu du paramètre
     * @return Configuration
     **/
    private function createConfiguration(string $name, string $content) : Configuration {
        $configuration = new Configuration();
        $configuration->setName($name);
        $configuration->setContent($content);
        return $configuration;
    }

    /**
     * Créer un paramètre pour le titre du site
     *
     * @return Configuration
     **/
    private function createSiteTitle() : Configuration {
        return $this->createConfiguration('site_title', 'Développeur Fullstack');
    }

    /**
     * Créer un paramètre pour l'introduction du site
     *
     * @return Configuration
     **/
    private function createIntroduction() : Configuration {
        $faker = Factory::create();
        return $this->createConfiguration('introduction', $faker->text(300));
    }

    /**
     * Créer un SVG pour l'introduction du site
     *
     * @return Configuration
     **/
    private function createSVG() : Configuration {
        return $this->createConfiguration('svg_introduction', '
            <svg height="100" width="100">
                <circle cx="50" cy="50" r="40" stroke="black" stroke-width="3" fill="red" />
            </svg> 
        ');
    }
}
