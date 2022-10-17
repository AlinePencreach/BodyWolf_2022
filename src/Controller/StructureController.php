<?php

namespace App\Controller;

use App\Entity\Salle;
use App\Entity\Structure;
use App\Form\StructureType;
use App\Repository\StructureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/structure')]
class StructureController extends AbstractController
{
    #[Route('/', name: 'app_structure_index', methods: ['GET'])]
    public function index(StructureRepository $structureRepository): Response
    {
        return $this->render('structure/index.html.twig', [
            'structures' => $structureRepository->findAll(),
        ]);
    }

   

    #[Route('/new', name: 'app_structure_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StructureRepository $structureRepository): Response
    {
        $structure = new Structure();
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structureRepository->save($structure, true);

            return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structure/new.html.twig', [
            'structure' => $structure,
            'structureForm' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structure_show', methods: ['GET'])]
    public function show(Structure $structure): Response
    {
        return $this->render('structure/show.html.twig', [
            'structure' => $structure,
            // 'salle' => $salle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_structure_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Structure $structure, StructureRepository $structureRepository): Response
    {
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structureRepository->save($structure, true);

            return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structure/edit.html.twig', [
            'structure' => $structure,
            'structureForm' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structure_delete', methods: ['POST'])]
    public function delete(Request $request, Structure $structure, StructureRepository $structureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$structure->getId(), $request->request->get('_token'))) {
            $structureRepository->remove($structure, true);
        }

        return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);

        return $this->render('structure/delete.html.twig', [
           
        ]);
    }

        //Make structure valide or not valide 
        #[Route('/makeItValide/{page}/{id}', name: 'app_structure_valide', methods: ['GET', 'POST'])]
        public function makeItValideStructure($page, $id, StructureRepository $structureRepository): Response
        {
            $structure = $structureRepository->find($id);
            if ($structure->isIsActive()) {
                $structure->setIsActive(false);
            } else {
                $structure->setIsActive(true);
            }
    
            $structureRepository->save($structure, true);
    
            $this->addFlash(
                'success',
                'La structure à bien été validé'
            );
    
    
            return $this->redirectToRoute('app_structure_index', [
                'page' => $page,
            ], Response::HTTP_SEE_OTHER);
        }
}
