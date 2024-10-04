<?php

namespace App\Controller;

use App\Entity\Destino;
use App\Form\DestinoType;
use App\Repository\DestinoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/destino')]
final class DestinoController extends AbstractController
{
    #[Route(name: 'app_destino_index', methods: ['GET'])]
    public function index(DestinoRepository $destinoRepository): Response
    {
        return $this->render('destino/index.html.twig', [
            'destinos' => $destinoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_destino_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $destino = new Destino();
        $form = $this->createForm(DestinoType::class, $destino);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($destino);
            $entityManager->flush();

            return $this->redirectToRoute('app_destino_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('destino/new.html.twig', [
            'destino' => $destino,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_destino_show', methods: ['GET'])]
    public function show(Destino $destino): Response
    {
        return $this->render('destino/show.html.twig', [
            'destino' => $destino,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_destino_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Destino $destino, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DestinoType::class, $destino);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_destino_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('destino/edit.html.twig', [
            'destino' => $destino,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_destino_delete', methods: ['POST'])]
    public function delete(Request $request, Destino $destino, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destino->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($destino);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_destino_index', [], Response::HTTP_SEE_OTHER);
    }
}
