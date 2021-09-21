<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @Assert\NotBlank(message="Vous devez remplir le champ")
     * @var string $fullname
     **/
    private string $fullname;

    /**
     * @Assert\NotBlank(message="Vous devez remplir ce champ !")
     * @Assert\Email(message="Le format de l'email est incorrect !")
     *
     * @var string $email
     **/
    private string $email;

    /**
     * @Assert\NotBlank(message="Vous devez remplir le champ!")
     * @var string $content
     **/
    private string $content;

    public function getFullname() : string {
        return $this->fullname;
    }

    public function setFullname(string $fullname) : self {
        $this->fullname = htmlentities($fullname);
        return $this;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setEmail(string $email) : self {
        $this->email = $email;
        return $this;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function setContent(string $content) : self {
        $this->content = htmlentities($content);
        return $this;
    }
}