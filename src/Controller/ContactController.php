<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ConfigurationRepository;
use App\Services\Email\EmailContact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * Envoie du mail de confirmation
     *
     * @Route("/contact", name="CONTACT")
     *
     * @param Request $request
     * @param ConfigurationRepository $configurationRepository
     * @param EmailContact $emailContact
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function contactAction(Request $request, ConfigurationRepository $configurationRepository, EmailContact $emailContact, \Swift_Mailer $mailer): Response
    {
        $contactEntity = new Contact();
        $contact_text = $configurationRepository->getConfigurationContact();
        $form = $this->createForm(ContactType::class, $contactEntity);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $sendMail = $emailContact->send($form->getData());

            if($sendMail) {
                $this->addFlash('success', "Votre message a été envoyer avec succès !");
                return $this->redirectToRoute('CONTACT');
            }
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
            'contact_text' => current($contact_text)
        ]);
    }
}
