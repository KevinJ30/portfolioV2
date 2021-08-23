<?php

namespace App\Controller\Admin;

use App\Entity\Skills;
use App\Form\Skill\CreateType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @var array $actions Les actions des compétences
     **/
    protected array $actions = [
        'home' => 'ADMIN_SKILLS_HOME',
        'create' => 'ADMIN_SKILLS_CREATE',
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
     *
     * @return Response
     */
    public function index() : Response {
        return $this->CRUDIndex(CreateType::class, ['name' => 'Nom de la compétences', 'type' => 'Type', 'level' => 'Niveau de la compétence', 'icons' => 'Icon de la compétence']);
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
     * Éditer une compétence
     *
     * @route("/edit/{id}", name="EDIT")
     *
     * @param Skills $skills Entité compétence
     * @return Response
     */
    public function edit(Skills $skills) : Response {
        return $this->CRUDEdit(CreateType::class, $skills);
    }

    /**
     * Supprimer une compétence
     *
     * @Route("/delete/{id}", name="DELETE", methods={"DELETE"})
     *
     * @param Skills $skill
     * @return JsonResponse
     **/
    public function delete(Skills $skill) : JsonResponse {
        return $this->CRUDDelete($skill);
    }
}
