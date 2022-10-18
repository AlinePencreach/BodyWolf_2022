<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


#[Route('/user')]
class UserController extends AbstractController
{
    #[Security("is_granted('ROLE_TEAM')", statusCode: 403)]
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

  
    #[Route('/profil', name: 'app_profil_index', methods: ['GET'])]
    public function indexProfil(UserRepository $userRepository): Response
    {
        return $this->render('user/profil.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Security("is_granted('ROLE_TEAM')", statusCode: 403)]
    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Security("is_granted('ROLE_TEAM')", statusCode: 403)]
    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Security("is_granted('ROLE_TEAM')", statusCode: 403)]
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Security("is_granted('ROLE_TEAM')", statusCode: 403)]
    #[Route('/user/makeItValide/{id}', name: 'app_user_valide', methods: ['GET', 'POST'])]
    public function makeItValideUser($id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        if ($user->isIsActive()) {
            $user->setIsActive(false);
        } else {
            $user->setIsActive(true);
        }

        $userRepository->save($user, true);

        $this->addFlash(
            'success',
            'L\'utilisateur à bien été valider'
        );


        return $this->redirect($_SERVER['HTTP_REFERER']);

        // return $this->redirectToRoute('app_user_index', [
        //     'page' => $page,
        // ], Response::HTTP_SEE_OTHER);
    }
}
