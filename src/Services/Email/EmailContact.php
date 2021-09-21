<?php

namespace App\Services\Email;

class EmailContact {
    private \Swift_Mailer $mailer;

    public function __construct(\Swift_Mailer $mailer) {
        $this->mailer = $mailer;
    }

    public function send(Object $data) : bool{
        return $this->mailer->send($this->createMail($data));
    }

    public function createMail(Object $data) : \Swift_Message {
        $message = new \Swift_Message('joudrier-kevin contact from ' . $data->getFullname());
        $message->setFrom('portfolio@joudrier-kevin.fr')
            ->setTo('contact@joudrier-kevin.fr')
            ->setBody(
                'Le contenu du mail',
                'text/html'
            );

        return $message;
    }

}