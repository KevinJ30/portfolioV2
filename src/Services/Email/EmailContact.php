<?php

namespace App\Services\Email;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Twig\Environment as TwigEnvironment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class EmailContact {
    private MailerInterface $mailer;
    private TwigEnvironment $twig;

    public function __construct(ContainerInterface $container, MailerInterface $mailer, TwigEnvironment $twig) {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * Envoie le message
     *
     * @param Object $data
     * @return bool
     **/
    public function send(Object $data) : bool {
        try {
            $this->mailer->send($this->createMail($data));
            return true;
        } catch (TransportExceptionInterface $e) {
            return false;
        }
    }

    public function createMail(Object $data) : Email{
            $email = new TemplatedEmail();

            try {
                $email->from('portfolio@joudrier-kevin.fr')
                    ->subject('Prise d\'informations joudrier-kevin.fr')
                    ->to('contact@joudrier-kevin.fr')
                    ->text('Sending your email at ' . $data->getEmail())
                    ->htmlTemplate('email/contact.html.twig')
                    ->context(['data' => $data])
                ;
            } catch (\Exception $e) {}

            return $email;
    }

}