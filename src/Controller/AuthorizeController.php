<?php

namespace App\Controller;

use App\Repository\AuthorizeRepository;
use App\Services\JWT\JWTInterface;
use App\Services\JWT\JWTService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorizeController extends AbstractController
{
    /**
     * Demande l'authorization d'accès au server
     *
     * @Route("/authorize", name="authorize", methods={"POST"})
     */
    public function __invoke(Request $request, AuthorizeRepository $authorizeRepository, JWTInterface $JWTService): Response
    {
        $authorization = $authorizeRepository->findOneBy([
            'app_name' => $request->get('app_name'),
            'token' => $request->get('token')
        ]);

        if($authorization) {
            // Generation du token
            $token = $JWTService->encode([
                'iss' => 'server',
                'sub' => 'Auhtorization',
                'exp' => time() + 600
            ]);

            return $this->json(['data' => $token]);
        }
        else {
            return $this->json([
                'error' => "Vous n'avez pas accès à cette ressource.",
            ], Response::HTTP_FORBIDDEN);
        }

    }
}
