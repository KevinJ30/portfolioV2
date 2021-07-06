<?php

namespace App\Controller\API;

use App\Auth\APIAuthorizationInterface;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route("/API", name="API_")
 **/
class SkillsController extends AbstractController implements APIAuthorizationInterface
{
    /**
     * Retourne la liste des compétences
     * @Route("/skills", name="skills")
     */
    public function index(SkillsRepository $skillsRepository): Response
    {
        $skills = $skillsRepository->findAll();
        return $this->json($skills, 200);
    }
}
