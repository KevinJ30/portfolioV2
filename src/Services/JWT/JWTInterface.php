<?php

namespace App\Services\JWT;

interface JWTInterface {

    /**
     * Créer un jeton JWT
     *
     * @param array $payload Information du jeton JWT
     * @return string Jeton JWT
     **/
    public function encode(array $payload): string;

    /**
     * Décode un jeton JWT
     *
     * @param string $jwt Jeton JWT
     * @return bool Validité du jeton
     **/
    public function decode(string $jwt) : bool;

}