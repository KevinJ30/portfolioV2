<?php

namespace App\Controller\Admin;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CRUDController extends AbstractController {

    /**
     * @var Entity
     **/
    private object $entity;

    /**
     * @var string $name Nom du CRUD
     **/
    private string $name;

    /**
     * @var object $repository
     **/
    private object $repository;

    // index
    public function index() : Response {
        var_dump($this->repository->findAll());
        $this->render('admin/skills/index.html');
    }

    // create
    public function create() : Response {

    }

    // edit
    public function edit() : Response {

    }

    // delete
    public function delete() : JsonResponse{

    }

    public function getEntity() : object {
        return $this->entity;
    }

    public function setEntity(object $entity) {
        $this->entity = $entity;
    }
}