<?php

namespace App\Tests\Controller;

use App\DataFixtures\AddHomeConfiguration;
use App\DataFixtures\AuthorizeFixtures;
use App\DataFixtures\ProjectsFixtures;
use App\DataFixtures\SkillsFixtures;
use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    protected AbstractDatabaseTool  $databaseTool;

    public function setUp(): void
    {
        // Load Fixtures
        $container = static::getContainer();
        $this->databaseTool = $container->get(DatabaseToolCollection::class)->get();

        $fixtures = $this->databaseTool->loadFixtures([
            AddHomeConfiguration::class,
            AuthorizeFixtures::class,
            ProjectsFixtures::class,
            SkillsFixtures::class,
            UserFixtures::class
        ]);
    }

    public function testHomeResponseOk() : void {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}
