<?php

namespace App\Controller\API;

use App\Repository\ConfigurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route("/API", name="API_")
 *
 * Class ConfigurationController
 * @package App\Controller\API
 **/
class ConfigurationController extends AbstractController
{
    /**
     * Retourne le parametre dans la table configuration du portfolio
     *
     * @Route("/configuration/{name}", name="configuration")
     */
    public function getParam(Request $request, ConfigurationRepository $configurationRepository): Response
    {
        $param = $configurationRepository->findBy(['name' => $request->get('name')]);
        return $this->json($param, 200);
    }
}
