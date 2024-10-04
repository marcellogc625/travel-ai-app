<?php

namespace App\Controller;

use App\Entity\Atividade;
use App\Form\Atividade1Type;
use App\Repository\AtividadeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/atividade')]
final class AtividadeController extends AbstractController
{
    #[Route(name: 'app_atividade_index', methods: ['GET'])]
    public function index(AtividadeRepository $atividadeRepository): Response
    {
        return $this->render('atividade/index.html.twig', [
            'atividades' => $atividadeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_atividade_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $atividade = new Atividade();
        $form = $this->createForm(Atividade1Type::class, $atividade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($atividade);
            $entityManager->flush();

            return $this->redirectToRoute('app_atividade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('atividade/new.html.twig', [
            'atividade' => $atividade,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_atividade_show', methods: ['GET'])]
    public function show(Atividade $atividade): Response
    {
        return $this->render('atividade/show.html.twig', [
            'atividade' => $atividade,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_atividade_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Atividade $atividade, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Atividade1Type::class, $atividade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_atividade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('atividade/edit.html.twig', [
            'atividade' => $atividade,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_atividade_delete', methods: ['POST'])]
    public function delete(Request $request, Atividade $atividade, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$atividade->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($atividade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_atividade_index', [], Response::HTTP_SEE_OTHER);
    }
}
