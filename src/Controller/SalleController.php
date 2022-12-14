<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Salle;
use App\Form\SalleType;
use App\Repository\UserRepository;
use App\Repository\SalleRepository;
use App\Repository\PermissionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/salle')]
class SalleController extends AbstractController
{
    #[Security("is_granted('ROLE_TEAM')")]
    #[Route('/', name: 'app_salle_index', methods: ['GET'])]
    public function index(SalleRepository $salleRepository): Response
    {
        return $this->render('salle/index.html.twig', [
            'salles' => $salleRepository->findAll(),
        ]);
    }

    #[Security("is_granted('ROLE_TEAM')")]
    #[Route('/new', name: 'app_salle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SalleRepository $salleRepository): Response
    {
        $salle = new Salle();
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salleRepository->save($salle, true);

            return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('salle/new.html.twig', [
            'salle' => $salle,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_salle_show', methods: ['GET'])]
    public function show(Salle $salle): Response
    {
        return $this->render('salle/show.html.twig', [
            'salle' => $salle,
        ]);
    }

    #[Security("is_granted('ROLE_TEAM')")]
    #[Route('/{id}/edit', name: 'app_salle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Salle $salle, SalleRepository $salleRepository): Response
    {
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salleRepository->save($salle, true);

            return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('salle/edit.html.twig', [
            'salle' => $salle,
            'form' => $form,
        ]);
    }

    #[Security("is_granted('ROLE_TEAM')")]
    #[Route('/{id}', name: 'app_salle_delete', methods: ['POST'])]
    public function delete(Request $request, Salle $salle, SalleRepository $salleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salle->getId(), $request->request->get('_token'))) {
            $salleRepository->remove($salle, true);
        }

        return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
    }

        //Make salle valide or not valide 
        #[Security("is_granted('ROLE_PARTNER')")]
        #[Route('/makeItValideSalle/{page}/{id}', name: 'app_valide_salle', methods: ['GET', 'POST'])]
        public function makeItValideSalle($page, $id, SalleRepository $salleRepository): Response
        {
            $salle = $salleRepository->find($id);
            if ($salle->isIsActive()) {
                $salle->setIsActive(false);
            } else {
                $salle->setIsActive(true);
            }
    
            $salleRepository->save($salle, true);
    
            $this->addFlash(
                'success',
                'Le statut de la salle vient d\'??tre modifi??'
            );
    
    
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }
}
