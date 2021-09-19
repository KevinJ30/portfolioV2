<?php

namespace App\DataFixtures;

use App\Entity\Skills;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Données de test de la configuration
 *
 * Class SkillFixtures
 * @package App\DataFixtures
 **/
class SkillFixtures extends Fixture
{
    const SKILL_TYPE = [
        'FRONT',
        'BACKEND',
        'OUTILS'
    ];

    /**
     * Ajoute les données dans la base de données
     *
     * @param ObjectManager $manager
     **/
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i <= 5; $i++) {
            $manager->persist($this->createSkill());
        }

        $manager->flush();
    }

    /**
     * Créer une compétence
     *
     * @return Skills
     **/
    private function createSkill() : Skills {
        $faker = Factory::create();

        $skill = new Skills();
        $skill->setName($faker->jobTitle);
        $skill->setType(self::SKILL_TYPE[rand(0, 2)]);
        $skill->setIcons('
        <svg height="100" width="100">
          <circle cx="50" cy="50" r="40" stroke="black" stroke-width="3" fill="red" />
        </svg>');
        $skill->setLevel(rand(0, 5));

        return $skill;
    }
}
