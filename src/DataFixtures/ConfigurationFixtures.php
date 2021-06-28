<?php

namespace App\DataFixtures;

use App\Entity\Configuration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConfigurationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $introduction = new Configuration();
        $introduction->setName('introduction')->setContent('Passionné par la création digitale depuis plus de dix ans, j’ai aujourd’hui acquis les compétences d’un développeur fullstack junior. Pendant toutes ces années je me suis auto-former en commençant par apprendre les langages de bases qui sont le HTML, CSS, JAVASCRIPT et j’ai continué par l’apprentissage du PHP.
        Lors de mon apprentissage, j’ai pu décrocher une première expérience avec une association sportive, pour laquelle j’ai réalisé un site web avec wordpress, des modules personnaliser et un thème personnalisé.
        Voulant mettre à profit mes compétences, j’ai effectué une formation de développeur d’application frontend diplômante, qui est équivalente à une License. Ceci m’a permis de renforcer mes compétences acquises.
        Je suis quelqu’un de nature organisé et ayant une grande curiosité qui pourrait être un atout pour vous.
        Si mon profil vous intéresse, n’hésitez pas à me contacter.');

        $manager->persist($introduction);
        $manager->flush();
    }
}
