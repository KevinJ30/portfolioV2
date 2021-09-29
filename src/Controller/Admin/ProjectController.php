<?php

namespace App\Controller\Admin;

use App\Entity\Projects;
use App\Form\ProjectType;
use App\Services\Images\ImageResizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Gestion des projets
 *
 * @route("/Dashboard/project", name="ADMIN_PROJECT_")
 **/
class ProjectController extends CRUDController {
    /**
     * @var string $entity Nom de la class de l'entité
     **/
    protected string $entity = Projects::class;

    /**
     * @var string $templatePath Chemin vers les fichiers template
     **/
    protected string $templatePath = "admin/project";

    /**
     * @var array<string> $actions Les actions des projets
     **/
    protected array $actions = [
        'home' => 'ADMIN_PROJECT_HOME',
        'create' => 'ADMIN_PROJECT_CREATE',
        'edit' => 'ADMIN_PROJECT_EDIT',
        'delete' => 'ADMIN_PROJECT_DELETE'
    ];

    /**
     * @var string $name Nom du CRUD
     **/
    protected string $name = "project";

    /**
     * Affiche la liste des projets
     *
     * @route("/", name="HOME")
     * @return Response
     **/
    public function index() : Response {
        return $this->CRUDIndex(ProjectType::class, [
            'title' => 'Titre du projet',
            'url' => 'Lien vers le projet',
            'thumb' => 'Image miniature',
            'excerpt' => 'Description courte'
        ]);
    }

    /**
     * Créer un nouveau projet
     *
     * @route("/create", methods={"GET", "POST"}, name="CREATE")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ImageResizer $resizerImage
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager, ImageResizer $resizerImage) : Response {
        $project = new Projects();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $image */
            $image = $project->getThumbFilename();

            $entityManager->persist($project);
            $entityManager->flush();
            $resizerImage->resize($project);

            return $this->redirectToRoute('ADMIN_PROJECT_HOME');
        }

        return $this->render('admin/project/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Éditer un projet
     *
     * @route("/edit/{id}", name="EDIT")
     *
     * @param Projects $projet
     * @return Response
     */
    public function edit(Projects $projet) : Response {
        return $this->CRUDEdit(ProjectType::class, $projet);
    }

    /**
     * Supprimer un projet
     *
     * @Route("/delete/{id}", name="DELETE", methods={"DELETE"})
     *
     * @param Projects $project
     * @return JsonResponse
     */
    public function delete(Projects $project) : JsonResponse {
        return $this->CRUDDelete($project);
    }
}