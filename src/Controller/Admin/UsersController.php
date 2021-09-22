<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UsersType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsersController
 *
 * CRUD Utilisateurs
 * @route("/Dashboard/users", name="ADMIN_USERS_")
 **/
class UsersController extends CRUDController {

    /**
     * @var string $entity
     **/
    protected string $entity = User::class;

    /**
     * @var string $templatePath Chemin vers les fichiers template
     **/
    protected string $templatePath = "admin/users";

    /**
     * @var array<string> $actions Les actions des utilisateurs
     **/
    protected array $actions = [
        'home' => 'ADMIN_USERS_HOME',
        'create' => 'ADMIN_USERS_CREATE',
        'edit' => 'ADMIN_USERS_EDIT',
        'delete' => 'ADMIN_USERS_DELETE'
    ];

    /**
     * @var string $name Nom du CRUD
     **/
    protected string $name = "users";

    /**
     * @route("/", name="HOME")
     *
     * @return Response
     **/
    public function index() : Response {
        return $this->CRUDIndex(UsersType::class, ['email' => 'Adresse email de connection', 'roles' => "Roles de l'utilisateur"]);
    }

    /**
     * Créer un nouvelle utilisateur
     *
     * @route("/create", methods={"POST"}, name="CREATE")
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */
    public function create(Request $request, UserPasswordHasherInterface $passwordHasher) : Response {
        $entity = new User();
        $form = $this->createForm(UsersType::class, $entity);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entity->setPassword($passwordHasher->hashPassword($entity, $entity->getPassword()));

            $this->entityManager->persist($form->getData());
            $this->entityManager->flush();

            $this->addFlash('success', 'La compétence a été ajouté');
        }
        else {
            $this->addFlash('error', 'Impossible d\'ajouter la compétence.');
        }

        return $this->redirectToRoute($this->actions['home']);
    }

    /**
     * Éditer un utilisateur
     *
     * @route("/edit/{id}", name="EDIT")
     *
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @param User $user
     * @return Response
     */
    public function edit(Request $request, UserPasswordHasherInterface $passwordHasher, User $user) : Response {
        $form = $this->createForm(UsersType::class, $user);
        $form->remove('password');

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'La compétence a été modifier');
            return $this->redirectToRoute($this->actions['home']);
        }

        return $this->render($this->templatePath . '/edit.html.twig', [
            'form' => $form->createView(),
            'name' => $this->name
        ]);
    }

    /**
     * Supprimer un utilisateur
     *
     * @Route("/delete/{id}", name="DELETE", methods={"DELETE"})
     *
     * @param User $user
     * @return JsonResponse
     */
    public function delete(User $user) : JsonResponse {
        return $this->CRUDDelete($user);
    }
}