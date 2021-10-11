<?php

namespace App\Controller;

use App\Repository\ProjectsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    public const PROJECT_PER_PAGE = 6;

    /**
     * @Route("/projects", name="PROJECTS")
     * @param Request $request
     * @param ProjectsRepository $projectsRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function indexAction(Request $request, ProjectsRepository $projectsRepository, PaginatorInterface $paginator): Response
    {
        $page = $request->get('page') ? $request->get('page') : 1;
        $projects = $paginator->paginate($projectsRepository->getQueryPaginate(), $page, self::PROJECT_PER_PAGE);
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projects->getTotalItemCount() ? $projects : null
        ]);
    }
}
