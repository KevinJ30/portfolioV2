<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class CreateAdminUserCommand extends Command
{

    protected static $defaultName = 'app:create-admin-user';
    protected static $defaultDescription = 'Créer un administrateur';

    private PasswordHasherFactoryInterface $hasherFactory;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(PasswordHasherFactoryInterface $hasherFactory, EntityManagerInterface $entityManager)
    {
        $this->hasherFactory = $hasherFactory;
        $this->entityManager = $entityManager;
        
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, 'Adresse email de connection')
            ->addArgument('password', InputArgument::OPTIONAL, 'Mot de passe')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        if(!$email || !$password) {
            throw new \InvalidArgumentException('Error invalid args : app:create-admin-user "email" "password"');
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format !');
        }


        $user = new User();
        $passwordHasher = $this->hasherFactory->getPasswordHasher($user);

        $user->setEmail($email)
             ->setPassword($passwordHasher->hash($password))
             ->setRoles(['ROLE_ADMIN']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln("L'utilisateur " . $user->getEmail() .  " a été ajouté !");

        return Command::SUCCESS;
    }
}
