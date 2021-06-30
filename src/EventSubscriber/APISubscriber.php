<?php

// src/EventSubscriber/TokenSubscriber.php
namespace App\EventSubscriber;

use App\Auth\APIAuthorizationInterface;
use App\Messages\APISecurityMessages;
use App\Services\JWT\JWTInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class APISubscriber implements EventSubscriberInterface
{
    /**
     * @var JWTInterface $jwtService
     */
    private $jwtService;

    /**
     * @var SerializerInterface $serializer
     **/
    private $serializer;

    /**
     * TokenSubscriber constructor.
     * @param JWTInterface $jwtService
     * @param SerializerInterface $serializer
     **/
    public function __construct(JWTInterface $jwtService, SerializerInterface $serializer)
    {
        $this->jwtService = $jwtService;
        $this->serializer = $serializer;
    }

    /**
     * Retourne la liste des souscriptions aux événements
     *
     * @return string[]
     **/
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }

    /**
     * Ajoute les attributs à la requête si le controller implémente l'interface TokenAuthenticatedInterface
     *
     * Attributs :
     * -----------
     * token_jwt<string> : Jeton de sécurité
     * api<bool> : Indique si on accède a une ressource de l'API
     *
     * @param ControllerEvent $event
     **/
    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof APIAuthorizationInterface) {
            $event->getRequest()->attributes->set('api', true);
        }
        else {
            $event->getRequest()->attributes->set('api', false);
        }
    }

    /**
     * Si la requête contient l'attribut api qui est égal a true
     * alors elle valide le token
     *
     * @param ResponseEvent $event
     * @return void
     **/
    public function onKernelResponse(ResponseEvent $event) {
        $token = $event->getRequest()->headers->get('token');
        if($event->getRequest()->attributes->get('api')) {
            if(is_null($token)) {
                $response = $this->forbiddenResponse();
                $event->setResponse($response);
            }

            if($token) {
                $validated_token = $this->jwtService->decode($token);

                if(!$validated_token) {
                    $response = $this->forbiddenResponse();
                    $event->setResponse($response);
                }
            }
        }
    }

    /**
     * Créer une réponse de type 403
     * @return JsonResponse
     **/
    private function forbiddenResponse(): JsonResponse
    {
        $serializer = new Serializer([new GetSetMethodNormalizer()], [new JsonEncoder()]);

        $json = $serializer->serialize([
            'message' => APISecurityMessages::MESSAGE_FORBIDDEN_ACCESS
        ], 'json', array_merge([
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ], []));

        return new JsonResponse($json, Response::HTTP_FORBIDDEN, [], true);
    }
}