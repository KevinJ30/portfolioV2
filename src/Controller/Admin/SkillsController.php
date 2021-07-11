<?php

namespace App\Controller\Admin;

use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route("/Admin/skills", name="ADMIN_SKILLS_")
 **/
class SkillsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SkillsRepository $skillsRepository): Response
    {
        $skills = $skillsRepository->findAll();

        return $this->render('admin/skills/index.html.twig', [
            'controller_name' => 'Admin/SkillsController',
            'skills' => $skills
        ]);
    }
}
