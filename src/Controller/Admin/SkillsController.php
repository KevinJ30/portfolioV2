<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use App\Form\Skill\CreateType;
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
 * @route("/Dashboard/skill", name="ADMIN_SKILLS_")
 **/
class SkillsController extends AbstractController
{
    /**
     * @route("/", name="HOME")
     *
     * @param SkillsRepository $skills
     * @return Response
     */
    public function index(SkillsRepository $skills) : Response {
        $skills = $skills->findAll();

        $skill = new Skills();
        $skill->setType('None');

        $form = $this->createForm(CreateType::class, $skill, [
            'action' => $this->generateUrl('ADMIN_SKILLS_CREATE')
        ]);

        return $this->render('admin/skills/index.html.twig', [
            'form' => $form->createView(),
            'skills' => $skills
        ]);
    }

    /**
     * @route("/create", methods={"POST"}, name="CREATE")
     * Créer une nouvelle compétence
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager) : Response {
        $skill = new Skills();

        $form = $this->createForm(CreateType::class, $skill);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'La compétence a été ajouté');
        }
        else {
            $this->addFlash('error', 'Impossible d\'ajouter la compétence.');
        }

        return $this->redirectToRoute('ADMIN_SKILLS_HOME');
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
