<?php

namespace App\Controller\API;

use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route("/API", name="API_")
 *
 * Class ProjectsController
 * @package App\Controller\API
 **/
class ProjectsController extends AbstractController
{
    /**
     * @Route("/projects", name="projects")
     */
    public function index(ProjectsRepository $projectsRepository): Response
    {
        $projects = $projectsRepository->findAll();
        return $this->json($projects);
    }
}
