<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use App\Form\Skill\CreateType;
use App\Repository\SkillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Gestion des compétences
 *
 * @route("/Dashboard/skill", name="ADMIN_SKILLS_")
 **/
class SkillsController extends AbstractController
{
    /**
     * Affiche la liste des compétences
     *
     * @route("/", name="HOME")
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
     * Créer une nouvelle compétence
     *
     * @route("/create", methods={"POST"}, name="CREATE")
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
     * Editer une compétence
     *
     * @route("/edit/{id}", name="EDIT")
     * @param Request $request
     * @param Skills $entity
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function edit(Request $request, Skills $entity, EntityManagerInterface $entityManager) : Response {
        $form = $this->createForm(CreateType::class, $entity);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($entity);
            $entityManager->flush();

            $this->addFlash('success', 'La compétence a été modifier');
            return $this->redirectToRoute('ADMIN_SKILLS_HOME');
        }

        return $this->render('admin/skills/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

//    /**
//     * Supprimer une compétence
//     *
//     * @Route("/delete/{id}", name="DELETE", methods={"DELETE"})
//     * @param Request $request
//     * @param Skills $skill
//     * @return Response
//     **/
//    public function delete(Request $request, Skills $skill, EntityManagerInterface $entityManager) {
//        $submittedToken = $request->request->get('token');
//
//        if($this->isCsrfTokenValid('skill-delete', $submittedToken)) {
//            $entityManager->remove($skill);
//            $entityManager->flush();
//
//            $this->addFlash('success', 'La compétence a été supprimé');
//        }
//        else {
//
//            $this->addFlash('error', 'Impossible de supprimer la compétence');
//        }
//
//        return $this->redirectToRoute('ADMIN_SKILLS_HOME');
//    }

    /**
     * Supprimer une compétence
     *
     * @Route("/delete/{id}", name="DELETE", methods={"DELETE"})
     * @param Request $request
     * @param Skills $skill
     * @return Response
     **/
    public function delete(Request $request, Skills $skill, EntityManagerInterface $entityManager) : JsonResponse {
        $submittedToken = json_decode($request->getContent());
        if($this->isCsrfTokenValid('skill-delete', $submittedToken->token)) {
            $entityManager->remove($skill);
            $entityManager->flush();

            return $this->json([
                'message' => 'La compétence a été supprimé.'
            ], Response::HTTP_OK);
        }

        return $this->json([
            'message' => 'Impossible de supprimer la compétence'
        ], 500);
    }
}
