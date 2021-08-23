<?php

namespace App\Controller\Admin;

use App\Form\Skill\CreateType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @param string $formType
     * @param array $fields
     * @return Response
     */
    public function CRUDIndex(string $formType, array $fields) : Response {
        $data = $this->getRepository()->findAll();
        $form = $this->createForm($formType, new $this->entity(), [
            'action' => $this->generateUrl($this->actions['create'])
        ]);

        return $this->render($this->templatePath . '/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data,
            'actions' => $this->getActions(),
            'fields' => $fields
        ]);
    }

    // create
    public function CRUDCreate(string $formType) : Response {
        $request = $this->requestStack->getCurrentRequest();
        $entity = new $this->entity();
        $form = $this->createForm($formType, $entity);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            $this->addFlash('success', 'La compétence a été crée');
            return $this->redirectToRoute($this->actions['home']);
        }

        return $this->redirectToRoute($this->actions['home']);
    }

    /**
     * Édite une compétence
     *
     * @param string $formType
     * @param Object $entity
     * @return Response
     */
    public function CRUDEdit(string $formType, Object $entity) : Response {
        $request = $this->requestStack->getCurrentRequest();
        $form = $this->createForm($formType, $entity);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            $this->addFlash('success', 'La compétence a été modifiée');
            return $this->redirectToRoute($this->actions['home']);
        }

        return $this->render($this->templatePath . '/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

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

    protected function getEntity() : string {
        return $this->entity;
    }

    protected function setEntity(string $entity) {
        $this->entity = $entity;
    }

    protected function getRepository() : ObjectRepository {
        return $this->entityManager->getRepository($this->entity);
    }

    protected function setTemplatePath(string $path) : void {
        $this->templatePath = $path;
    }

    protected function addAction(string $name, string $routeName) : void {
        $this->actions[$name] = $routeName;
    }

    protected function getActions() : array {
        return $this->actions;
    }
}