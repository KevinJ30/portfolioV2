<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class CRUDController extends AbstractController {

    /**
     * @var string $entity Nom de la class de l'entité
     **/
    protected string $entity = '';

    /**
     * @var EntityManagerInterface
     **/
    protected EntityManagerInterface $entityManager;

    /**
     * @var string $templatePath Chemin vers les fichiers template
     **/
    protected string $templatePath;

    /**
     * @var array $actions
     **/
    protected array $actions = [];

    /**
     * @var string $name Nom du CRUD
     */
    protected string $name = "CRUD";

    /**
     * @var RequestStack $requestStack
     **/
    private RequestStack $requestStack;


    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * Affiche les données du CRUD dans un tableaux
     * et définie des actions pour le CRUD
     *
     * @param string $formType : Formulaire type syfmony
     * @return Response
     */
    public function CRUDIndex(string $formType) : Response {
        $data = $this->getRepository()->findAll();
        $form = $this->createForm($formType, new $this->entity(), [
            'action' => $this->generateUrl('ADMIN_SKILLS_CREATE')
        ]);

        return $this->render($this->templatePath . '/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data,
            'actions' => $this->getActions()
        ]);
    }

    // create
    public function CRUDCreate(string $formType) : Response {
        $entity = new $this->entity();

        $form = $this->createForm($formType, $entity);
        $form->handleRequest($this->requestStack->getCurrentRequest());

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($form->getData());
            $this->entityManager->flush();

            $this->addFlash('success', 'La compétence a été ajouté');
        }
        else {
            $this->addFlash('error', 'Impossible d\'ajouter la compétence.');
        }

        return $this->redirectToRoute($this->actions['home']);
    }

    // edit
    public function CRUDEdit() : Response {

    }

    // delete

    /**
     * Supprime un item
     *
     * @param object $entity : Entité à supprimer
     * @return JsonResponse
     */
    public function CRUDDelete(object $entity) : JsonResponse{
        $request = $this->requestStack->getCurrentRequest();
        $submittedToken = json_decode($request->getContent());

        if($this->isCsrfTokenValid('item-delete', $submittedToken->token)) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return $this->json([
                'message' => 'La compétence a été supprimé.'
            ], Response::HTTP_OK);
        }

        return $this->json([
            'message' => 'Impossible de supprimer la compétence'
        ], 500);
    }

    public function getEntity() : string {
        return $this->entity;
    }

    public function setEntity(string $entity) {
        $this->entity = $entity;
    }

    public function getRepository() : ObjectRepository {
        return $this->entityManager->getRepository($this->entity);
    }

    public function setTemplatePath(string $path) : void {
        $this->templatePath = $path;
    }

    protected function addAction(string $name, string $routeName) : void {
        $this->actions[$name] = $routeName;
    }

    protected function getActions() : array {
        return $this->actions;
    }
}