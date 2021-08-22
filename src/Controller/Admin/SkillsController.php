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
class SkillsController extends CRUDController
{
    /**
     * @var string $entity Nom de la class de l'entité
     **/
    protected string $entity = Skills::class;

    /**
     * @var string $templatePath Chemin vers les fichiers template
     **/
    protected string $templatePath = "admin/skills";

    /**
     * @var array $actions
     **/
    protected array $actions = [
        'home' => 'ADMIN_SKILL_HOME',
        'edit' => 'ADMIN_SKILLS_EDIT',
        'delete' => 'ADMIN_SKILLS_DELETE'
    ];

    /**
     * @var string $name Nom du CRUD
     **/
    protected string $name = "skill";

    /**
     * Affiche la liste des compétences
     *
     * @route("/", name="HOME")
     * @return Response
     */
    public function index() : Response {
        return $this->CRUDIndex(CreateType::class);
    }

    /**
     * Créer une nouvelle compétence
     *
     * @route("/create", methods={"POST"}, name="CREATE")
     * @return Response
     */
    public function create() : Response {
        return $this->CRUDCreate(CreateType::class);
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

    /**
     * Supprimer une compétence
     *
     * @Route("/delete/{id}", name="DELETE", methods={"DELETE"})
     * @param Request $request
     * @param Skills $skill
     * @return JsonResponse
     **/
    public function delete(Skills $skill) : JsonResponse {
        return $this->CRUDDelete($skill);
    }
}
