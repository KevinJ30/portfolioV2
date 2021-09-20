<?php

namespace App\Tests\Command;

use App\DataFixtures\ConfigurationFixtures;
use App\DataFixtures\ProjectFixtures;
use App\DataFixtures\SkillFixtures;
use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateAdminUserCommandTest extends KernelTestCase
{
    protected AbstractDatabaseTool  $databaseTool;

    protected ?KernelBrowser $client = null;

    public function setUp(): void
    {
        $container = static::getContainer();
        $this->databaseTool = $container->get(DatabaseToolCollection::class)->get();

        $fixtures = $this->databaseTool->loadFixtures([
            ConfigurationFixtures::class,
            UserFixtures::class,
            SkillFixtures::class,
            ProjectFixtures::class
        ]);
    }

    public function testExecuteCommand(): void
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-admin-user');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'email' => 'test@test.fr',
            'password' => 'myPassword'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("L'utilisateur test@test.fr a été ajouté !", $output);
    }
}
