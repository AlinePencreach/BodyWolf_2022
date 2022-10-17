<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

#[Route('/contact')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'app_contact_index', methods: ['GET'])]
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_contact_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);

            return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_show', methods: ['GET'])]
    public function show(Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);

            return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_delete', methods: ['POST'])]
    public function delete(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $contactRepository->remove($contact, true);
        }

        return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/contact/makeItValidePartner/{id}', name: 'app_partner_valide', methods: ['GET', 'POST'])]
    public function makeItValidePartner($id, ContactRepository $contactRepository, MailerInterface $mailer): Response
    {
        $contact = $contactRepository->find($id);
        if ($contact->isIsActive()) {
            $contact->setIsActive(false);
        } else {
            $contact->setIsActive(true);
            $email = (new TemplatedEmail())
            ->from('contact.bodywolf@gmail.com')
            ->to('contact.bodywolf@gmail.com')
            // ->to($contact->getEmail())
            ->subject('Enregistez-vous sur BodyWolf Partenaire')

             // path of the Twig template to render
            ->htmlTemplate('emails/signupPartner.html.twig')
    ;

            $mailer->send($email);
            
        }

        $contactRepository->save($contact, true);
        


        $this->addFlash(
            'success',
            'L\'utilisateur à bien été valider'
        );


        return $this->redirect($_SERVER['HTTP_REFERER']);

    }

    #[Route('/contact/makeItValideManager/{id}', name: 'app_manager_valide', methods: ['GET', 'POST'])]
    public function makeItValideManager($id, ContactRepository $contactRepository, MailerInterface $mailer): Response
    {
        $contact = $contactRepository->find($id);
        if ($contact->isIsActive()) {
            $contact->setIsActive(false);
        } else {
            $contact->setIsActive(true);
            $email = (new TemplatedEmail())
            ->from('contact.bodywolf@gmail.com')
            ->to('contact.bodywolf@gmail.com')
            // ->to($contact->getEmail())
            ->subject('Enregistez-vous sur BodyWolf Manager')

             // path of the Twig template to render
            ->htmlTemplate('emails/signupManager.html.twig')
    ;

            $mailer->send($email);
            
         }

        $contactRepository->save($contact, true);
        


        $this->addFlash(
            'success',
            'L\'utilisateur à bien été valider'
        );


        return $this->redirect($_SERVER['HTTP_REFERER']);

    }

    #[Route('/contact/makeItValide/{id}', name: 'app_contact_valide', methods: ['GET', 'POST'])]
    public function makeItValide($id, ContactRepository $contactRepository): Response
    {
        $contact = $contactRepository->find($id);
        if ($contact->isIsActive()) {
            $contact->setIsActive(false);
        } else {
            $contact->setIsActive(true);
         }

        $contactRepository->save($contact, true);

        return $this->redirect($_SERVER['HTTP_REFERER']);

    }


}
