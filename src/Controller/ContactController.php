<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerService $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $username = $form->get('nom')->getData() . ' ' . $form->get('prenom')->getData();;

            $to = $this->getParameter('app_email');

            $from = $form->get('email')->getData();

            $message = $form->get('message')->getData();

            $mailer->sendMail($from, $to, $message, $username);

            $this->addFlash('success', 'Votre message a bien été envoyé, nous vous recontacterons dans peut de temps');
            return $this->redirectToRoute('app_contact');
        }

        return $this->renderForm('contact/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
