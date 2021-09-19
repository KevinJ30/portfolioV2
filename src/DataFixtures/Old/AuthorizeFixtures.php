<?php

namespace App\DataFixtures;

use App\Entity\Authorize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $app = new Authorize();
        $app->setAppName('SPA');
        $app->setToken('1234');

        $manager->persist($app);
        $manager->flush();
    }
}
