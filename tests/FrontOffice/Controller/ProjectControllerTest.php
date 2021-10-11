<?php

namespace App\Tests\FrontOffice\Controller;

use App\DataFixtures\ConfigurationFixtures;
use App\DataFixtures\ProjectFixtures;
use App\DataFixtures\SkillFixtures;
use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class ProjectControllerTest extends WebTestCase {

    protected AbstractDatabaseTool  $databaseTool;
    protected KernelBrowser $client;

    public function setup() : void {
        $this->client = static::createClient();

        /** @var ContainerInterface $container */
        $container = static::getContainer();

        $this->databaseTool = $container->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->withPurgeMode(1)->loadFixtures([
            ConfigurationFixtures::class,
            UserFixtures::class,
            SkillFixtures::class,
            ProjectFixtures::class
        ]);
    }

    /**
     * Devrait renvoyer une réponse 200
     * @return void
     */
    public function testSuccessfullyResponseIndex() : void {
        $crawler = $this->client->request('GET', '/projects');
        $this->assertResponseIsSuccessful();
    }

    /**
     * @param Crawler $crawler
     * @param int $expectedProject Nombre de projet attendu
     */
    public function assertCountProject(Crawler $crawler, int $expectedProject) : void {
        $projectCard = $crawler->filter('.projects__container .card');
        $this->assertCount($expectedProject, $projectCard);
    }

    /**
     * Devrait afficher tous les projets de la base de données
     **/
    public function  testDisplayAllProjects() : void {
        $crawler = $this->client->request('GET', '/projects');
        $this->assertCountProject($crawler, 6);
    }

    /**
     * Devrait afficher un message si aucun projet n'est présent
     * dans la base de données
     **/
    public function testNotContainProject() : void {
        $this->databaseTool->withPurgeMode(1)->loadFixtures([
            ConfigurationFixtures::class,
            UserFixtures::class,
            SkillFixtures::class
        ]);

        $crawler = $this->client->request('GET', '/projects');
        $noContainMessage = $crawler->filter('p');
        $this->assertSelectorTextContains('p', "Il n'y a encore aucun projet !");
    }

    /**
     * Devrais afficher les 6 projets de la page 1
     **/
    public function testDisplaySixProjectForPaginate() : void {
        $crawler = $this->client->request('GET', '/projects');
        $this->assertCountProject($crawler, 6);
    }

    /**
     * Devrait afficher la navigation pour la pagination
     **/
    public function testDisplayPaginationNav() : void {
        $crawler = $this->client->request('GET', '/projects');
        $paginatorNav = $crawler->filter('.pagination');
        $this->assertEquals(1, $paginatorNav->count());
    }

    /**
     * Ne devrait pas afficher la pagination si
     * il n'y a aucun projet
     **/
    public function testNotDisplayPaginationWithNoProject() : void {
        $this->databaseTool->withPurgeMode(1)->loadFixtures([
            ConfigurationFixtures::class,
            UserFixtures::class,
            SkillFixtures::class
        ]);

        $crawler = $this->client->request('GET', '/projects');
        $paginatorNav = $crawler->filter('.pagination');
        $this->assertEquals(0, $paginatorNav->count());
    }
}