<?php

namespace App\DataFixtures;

use App\Entity\Projects;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $project = new Projects();

        $project->setTitle('Chalet Caviar - Agence de chalet')
                ->setDescription('
                    # Agence immobilière
                    Spécialisé dans les chalets en montagne
                    ---------------------------------------
                    Construction du site avec wordpress, réalisation des pages avec Elementor. Sélection de plugins pertinent pour la gestion de l\'agence
                ')
                ->setUrl('http://chalet-caviar.joudrier-kevin.fr/')
                ->setThumb('https://via.placeholder.com/300');

        $manager->persist($project);
        $manager->flush();
    }
}
