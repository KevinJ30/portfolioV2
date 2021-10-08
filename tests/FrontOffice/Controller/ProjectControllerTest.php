<?php

namespace App\Tests\FrontOffice\Controller;

use App\DataFixtures\ConfigurationFixtures;
use App\DataFixtures\ProjectFixtures;
use App\DataFixtures\SkillFixtures;
use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase {

    protected AbstractDatabaseTool  $databaseTool;
    protected ?KernelBrowser $client = null;

    public function setup() : void {
        $this->client = static::createClient();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $fixtures = $this->databaseTool->withPurgeMode(true)->loadFixtures([
            ConfigurationFixtures::class,
            UserFixtures::class,
            SkillFixtures::class,
            ProjectFixtures::class
        ]);
    }

    /**
     * @return void
     */
    public function testSuccessfullyResponseIndex() : void {
        $crawler = $this->client->request('GET', '/projects');
        $this->assertResponseIsSuccessful();
    }

    public function  testDisplayAllProjects() : void {
        $crawler = $this->client->request('GET', '/projects');
        $projectCard = $crawler->filter('.projects__container .card');
        $this->assertCount(10, $projectCard);
    }


}