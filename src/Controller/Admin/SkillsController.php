<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use App\Repository\SkillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @route("/Admin/skills", name="ADMIN_SKILLS_")
 **/
class SkillsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, SkillsRepository $skillsRepository): Response
    {
        $skills = $skillsRepository->findAll();

        return $this->render('admin/skills/index.html.twig', [
            'controller_name' => 'Admin/SkillsController',
            'skills' => $skills
        ]);
    }

    /**
     * @Route("/{id}", methods={"POST", "PUT"}, name="UPDATE")
     **/
    public function update(Request $request, int $id, SkillsRepository $skillsRepository, EntityManagerInterface $entityManager) : JsonResponse {
        $skill = $skillsRepository->find($id);
        $data = json_decode($request->getContent());
        $key = 'set'.ucfirst($data->key);
        $skill->$key($data->value);

        $entityManager->persist($skill);
        $entityManager->flush();

        return $this->json([
            'message' => 'Les données ont été mise à jour...',
            'data' => json_encode($skill)
        ], Response::HTTP_OK);
    }
}
