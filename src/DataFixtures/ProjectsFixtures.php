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
                ->setthumb_url('https://via.placeholder.com/300')
                ->setExcerpt("Construction d'un site avec wordpress réalisation pour un client.")
                ->setDetails('HTML, CSS, React, Wordpress');
        $manager->persist($project);
        $manager->flush();
    }
}
