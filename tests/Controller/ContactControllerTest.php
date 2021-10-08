<?php

namespace App\Tests\Controller;

use App\DataFixtures\ConfigurationFixtures;
use App\DataFixtures\ProjectFixtures;
use App\DataFixtures\SkillFixtures;
use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    protected AbstractDatabaseTool $databaseTool;

    protected KernelBrowser $client;

    public function setUp(): void
    {
        // Load Fixtures
        $this->client = self::createClient();

        /** @var ContainerInterface $container */
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
        /** @var KernelBrowser $crawler */
        $crawler = $this->client->request('GET', '/contact');
        $this->assertResponseIsSuccessful();
    }

    public function testGetParameterInDatabase() : void  {
        $crawler = $this->client->request('GET', '/contact');
        $contactText = $crawler->filter('h1 + p');
        $this->assertStringContainsString("Plus d'information", $contactText->text());
    }

    public function testInvalidFormData() : void {
        $formFields = [
            'contact[fullname]' => '',
            'contact[email]' => '.fr',
            'contact[content]' => ''
        ];

        $this->client->request('GET', '/contact');
        $crawler = $this->client->submitForm('Envoyer', $formFields);
        $errorValidation = $crawler->filter('.invalid-feedback');
        $this->assertEquals(3, $errorValidation->count());
    }

    public function testValidFormData() : void {
        $formData = [
            'contact[fullname]' => 'Testing my app',
            'contact[email]' => 'test.app@test.fr',
            'contact[content]' => 'my content application demo'
        ];

        $crawler = $this->client->request('GET', '/contact');
         $form = $crawler->selectButton('Envoyer')->form($formData);
         $this->client->submit($form);
         $crawler = $this->client->followRedirect();
         $this->assertEquals(1, $crawler->filter('.alert.alert-success')->count());
    }
}
