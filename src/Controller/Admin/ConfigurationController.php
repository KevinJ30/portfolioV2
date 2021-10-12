<?php

namespace App\Controller\Admin;

use App\Entity\Configuration;
use App\Form\ConfigurationType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Gestion des configuration
 *
 * @route("/dashboard/configuration", name="ADMIN_CONFIGURATION_")
 **/
class ConfigurationController extends CRUDController {
    /**
     * @var string $entity Nom de la class de l'entité
     **/
    protected string $entity = Configuration::class;

    /**
     * @var string $templatePath Chemin vers les fichiers template
     **/
    protected string $templatePath = "admin/configuration";

    /**
     * @var array<string> $actions Les actions des compétences
     **/
    protected array $actions = [
        'home' => 'ADMIN_CONFIGURATION_HOME',
        'create' => 'ADMIN_CONFIGURATION_CREATE',
        'edit' => 'ADMIN_CONFIGURATION_EDIT',
        'delete' => 'ADMIN_CONFIGURATION_DELETE'
    ];

    /**
     * @var string $name Nom du CRUD
     **/
    protected string $name = "configuration";

    /**
     * Affiche la liste des configuration
     *
     * @route("/", name="HOME")
     * @return Response
     **/
    public function index() : Response {
        return $this->CRUDIndex(ConfigurationType::class, [
            'name' => 'Nom de la configuration',
            'content' => 'Contenu de la configuration'
        ]);
    }

    /**
     * Créer une nouvelle configuration
     *
     * @route("/create", methods={"POST"}, name="CREATE")
     * @return Response
     */
    public function create() : Response {
        return $this->CRUDCreate(ConfigurationType::class);
    }

    /**
     * Éditer une configuration
     *
     * @route("/edit/{id}", name="EDIT")
     *
     * @param Configuration $configuration
     * @return Response
     */
    public function edit(Configuration $configuration) : Response {
        return $this->CRUDEdit(ConfigurationType::class, $configuration);
    }

    /**
     * Supprimer une configuration
     *
     * @Route("/delete/{id}", name="DELETE", methods={"DELETE"})
     *
     * @param Configuration $configuration
     * @return JsonResponse
     */
    public function delete(Configuration $configuration) : JsonResponse {
        return $this->CRUDDelete($configuration);
    }
}