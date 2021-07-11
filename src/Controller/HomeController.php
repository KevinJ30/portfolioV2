<?php

namespace App\Controller;

use App\Repository\ConfigurationRepository;
use App\Repository\ProjectsRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ConfigurationRepository $configurationRepository, SkillsRepository $skillsRepository, ProjectsRepository $projectsRepository): Response
    {
        $configuration = $configurationRepository->getConfigurationHome();
        $skills = $skillsRepository->getSkillsGroupedType();
        $projects = $projectsRepository->getLastProjects(4);

        /**
         * Récuperer les informations de la home page dans la table configuration
         **/
        // Get Introduction & get site_title
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'site_title' => $configuration[1]->getContent(),
            'svg_introduction' => $configuration[0]->getContent(),
            'introduction' => $configuration[2]->getContent(),
            'skills' => $skills,
            'projects' => $projects
        ]);
    }
}
