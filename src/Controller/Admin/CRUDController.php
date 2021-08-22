<?php

namespace App\Controller\Admin;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ObjectRepository;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CRUDController extends AbstractController {

    /**
     * @var string $entity Nom de la class de l'entité
     **/
    private string $entity;

    /**
     * @var object $repository
     **/
    private object $repository;

    /**
     * @var EntityManagerInterface
     **/
    private EntityManagerInterface $entityManager;

    /**
     * @var string $templatePath Chemin vers les fichiers template
     **/
    private string $templatePath;

    /**
     * @var array $actions
     **/
    private array $actions = [];

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
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
        $form = $this->createForm($formType, new $this->entity());

        return $this->render($this->templatePath . '/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data,
            'actions' => $this->getActions()
        ]);
    }

    // create
    public function CRUDCreate() : Response {

    }

    // edit
    public function CRUDEdit() : Response {

    }

    // delete
    public function CRUDdelete() : JsonResponse{

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