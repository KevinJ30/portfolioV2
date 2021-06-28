<?php

namespace App\Services\JWT;

use App\Services\JWT\JWTInterface;
use Firebase\JWT\JWT;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class JWTService implements JWTInterface{

    /**
     * @const ALGORITHM algorithme de hachage
     **/
    const ALGORITHM = ['HS256'];

    /**
     * @var string $secret_api_key Clé de hachage
     **/
    private $secret_api_key;

    /**
     * JWTService constructor.
     * @param ParameterBagInterface $parameter
     **/
    public function __construct(ParameterBagInterface $parameter) {
        $this->secret_api_key = $parameter->get('API_ACCESS');
    }

    /**
     * Créer un jeton JWT
     *
     * @param array $payload Information du jeton
     * @return string jeton
     **/
    public function encode(array $payload): string
    {
        return JWT::encode($payload, $this->secret_api_key);
    }

    /**
     * Valide un jeton JWT
     *
     * @param string $jwt
     * @return bool|Throws
     **/
    public function decode(string $jwt): bool
    {
        try {
            JWT::decode($jwt, $this->secret_api_key, self::ALGORITHM);
            return true;
        }
        catch(\InvalidArgumentException | \UnexpectedValueException | \DomainException $e ) {
            return false;
        }
    }
}