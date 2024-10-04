<?php

namespace App\Controller;

use App\Entity\Roteiro;
use App\Form\RoteiroType;
use App\Repository\RoteiroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/roteiro')]
final class RoteiroController extends AbstractController
{
    #[Route(name: 'app_roteiro_index', methods: ['GET'])]
    public function index(RoteiroRepository $roteiroRepository): Response
    {
        return $this->render('roteiro/index.html.twig', [
            'roteiros' => $roteiroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_roteiro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $roteiro = new Roteiro();
        $form = $this->createForm(RoteiroType::class, $roteiro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($roteiro);
            $entityManager->flush();

            return $this->redirectToRoute('app_roteiro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('roteiro/new.html.twig', [
            'roteiro' => $roteiro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_roteiro_show', methods: ['GET'])]
    public function show(Roteiro $roteiro): Response
    {
        return $this->render('roteiro/show.html.twig', [
            'roteiro' => $roteiro,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_roteiro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Roteiro $roteiro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RoteiroType::class, $roteiro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_roteiro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('roteiro/edit.html.twig', [
            'roteiro' => $roteiro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_roteiro_delete', methods: ['DELETE'])]
    public function delete(Request $request, Roteiro $roteiro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $roteiro->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($roteiro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_roteiro_index', [], Response::HTTP_SEE_OTHER);
    }
}
