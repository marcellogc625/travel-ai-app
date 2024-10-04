<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Form\PerfilType;
use App\Repository\PerfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/perfil')]
final class PerfilController extends AbstractController
{
    #[Route(name: 'app_perfil_index', methods: ['GET'])]
    public function index(PerfilRepository $perfilRepository): Response
    {
        return $this->render('perfil/index.html.twig', [
            'perfils' => $perfilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_perfil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $perfil = new Perfil();
        $form = $this->createForm(PerfilType::class, $perfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($perfil);
            $entityManager->flush();

            return $this->redirectToRoute('app_perfil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('perfil/new.html.twig', [
            'perfil' => $perfil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perfil_show', methods: ['GET'])]
    public function show(Perfil $perfil): Response
    {
        return $this->render('perfil/show.html.twig', [
            'perfil' => $perfil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_perfil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Perfil $perfil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PerfilType::class, $perfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_perfil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('perfil/edit.html.twig', [
            'perfil' => $perfil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perfil_delete', methods: ['POST'])]
    public function delete(Request $request, Perfil $perfil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $perfil->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($perfil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_perfil_index', [], Response::HTTP_SEE_OTHER);
    }
}
