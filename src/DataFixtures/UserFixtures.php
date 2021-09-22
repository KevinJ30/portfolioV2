<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Données de test de la configuration
 *
 * Class UserFixtures
 * @package App\DataFixtures
 **/
class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * Ajoute les données dans la base de données
     *
     * @param ObjectManager $manager
     **/
    public function load(ObjectManager $manager) : void
    {
        $manager->persist($this->createUser(['ROLE_ADMIN'], 'admin@test.fr', 'admin'));
        $manager->persist($this->createUser(['ROLE_MEMBER'], 'member@test.fr', 'member'));

        $manager->flush();
    }

    /**
     * Créer une compétence
     *
     * @param array<string> $roles Roles de l'utilisateur
     * @param string $email Email de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return User
     */
    private function createUser(array $roles, string $email, string $password) : User {
        $faker = Factory::create();

        $user = new User();
        $user->setEmail($email)
             ->setRoles($roles)
             ->setPassword($this->passwordHasher->hashPassword($user, $password));

        return $user;
    }
}
