<?php

namespace App\Tests\Controller;

use App\DataFixtures\ConfigurationFixtures;
use App\DataFixtures\ProjectFixtures;
use App\DataFixtures\SkillFixtures;
use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    protected AbstractDatabaseTool  $databaseTool;

    protected ?KernelBrowser $client = null;

    public function setUp(): void
    {
        // Load Fixtures
        $this->client = static::createClient();

        $container = static::getContainer();
        $this->databaseTool = $container->get(DatabaseToolCollection::class)->get();

        $fixtures = $this->databaseTool->loadFixtures([
            ConfigurationFixtures::class,
            UserFixtures::class,
            SkillFixtures::class,
            ProjectFixtures::class
        ]);

    }

    /**
     * Devrait retourner une réponse 200
     **/
    public function testHomeResponseOk() : void {
        $crawler = $this->client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Devrait afficher le titre du site présente dans les configurations
     **/
    public function testTitleCorrespondingDatabase() : void {
        $crawler = $this->client->request('GET', '/');
        $siteTitle = $crawler->filter('h1.section__title')->text();
        $this->assertEquals('Développeur Fullstack', $siteTitle);
    }

    /**
     * Devrait afficher toutes les compétences présente dans la base de données
     **/
    public function testListOfFullSkillOnDatabase() : void {
        $crawler = $this->client->request('GET', '/');
        $allSkills = $crawler->filter('.skill')->count();
        $this->assertEquals(6, $allSkills);
    }

    /**
     * Devrait afficher au maximum 4 projet sur la page d'accueil
     **/
    public function testDisplayMaxFourProject() : void {
        $crawler = $this->client->request('GET', '/');
        $projects = $crawler->filter('.projects__container .card')->count();
        $this->assertEquals(4, $projects);
    }
}
