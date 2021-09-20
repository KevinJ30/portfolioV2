<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ConfigurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="CONTACT")
     * @param ConfigurationRepository $configurationRepository
     * @return Response
     */
    public function contactAction(ConfigurationRepository $configurationRepository): Response
    {
        $contact_text = $configurationRepository->getConfigurationContact();
        $form = $this->createForm(ContactType::class, []);

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
            'contact_text' => current($contact_text)
        ]);
    }
}
