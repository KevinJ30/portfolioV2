<?php

namespace App\Controller;

use App\Repository\ConfigurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ConfigurationRepository $configurationRepository): Response
    {
        $configuration = $configurationRepository->getConfigurationHome();

        /**
         * Récuperer les informations de la home page dans la table configuration
         **/
        // Get Introduction & get site_title
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'site_title' => $configuration[0]->getContent(),
            'introduction' => $configuration[1]->getContent()
        ]);
    }
}
