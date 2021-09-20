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

class ContactControllerTest extends WebTestCase
{
    protected AbstractDatabaseTool  $databaseTool;

    protected ?KernelBrowser $client = null;

    public function setUp(): void
    {
        // Load Fixtures
        $this->client = static::createClient();

        $container = static::getContainer();
        $this->databaseTool = $container->get(DatabaseToolCollection::class)->get();

        $fixtures = $this->databaseTool->withPurgeMode(true)->loadFixtures([
            ConfigurationFixtures::class,
            UserFixtures::class,
            SkillFixtures::class,
            ProjectFixtures::class
        ]);

    }

    /**
     * Devrait retourner une réponse 200
     **/
    public function testRequestResponseStatusSuccessful(): void
    {
        $crawler = $this->client->request('GET', '/contact');
        $this->assertResponseIsSuccessful();
    }

    public function testGetParameterInDatabase() : void  {
        $crawler = $this->client->request('GET', '/contact');
        $contactText = $crawler->filter('h1 + p');
        $this->assertStringContainsString("Plus d'information", $contactText->text());
    }
}
