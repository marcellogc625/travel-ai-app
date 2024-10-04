<?php

namespace App\Controller;

use App\Entity\Hospedagem;
use App\Form\HospedagemType;
use App\Repository\HospedagemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hospedagem')]
final class HospedagemController extends AbstractController
{
    #[Route(name: 'app_hospedagem_index', methods: ['GET'])]
    public function index(HospedagemRepository $hospedagemRepository): Response
    {
        return $this->render('hospedagem/index.html.twig', [
            'hospedagems' => $hospedagemRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hospedagem_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hospedagem = new Hospedagem();
        $form = $this->createForm(HospedagemType::class, $hospedagem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hospedagem);
            $entityManager->flush();

            return $this->redirectToRoute('app_hospedagem_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hospedagem/new.html.twig', [
            'hospedagem' => $hospedagem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hospedagem_show', methods: ['GET'])]
    public function show(Hospedagem $hospedagem): Response
    {
        return $this->render('hospedagem/show.html.twig', [
            'hospedagem' => $hospedagem,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hospedagem_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hospedagem $hospedagem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HospedagemType::class, $hospedagem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hospedagem_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hospedagem/edit.html.twig', [
            'hospedagem' => $hospedagem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hospedagem_delete', methods: ['POST'])]
    public function delete(Request $request, Hospedagem $hospedagem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hospedagem->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($hospedagem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hospedagem_index', [], Response::HTTP_SEE_OTHER);
    }
}
