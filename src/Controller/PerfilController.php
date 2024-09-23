<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Repository\PerfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/perfis")
 */
class PerfilController extends AbstractController
{
    private PerfilRepository $perfilRepository;

    public function __construct(PerfilRepository $perfilRepository)
    {
        $this->perfilRepository = $perfilRepository;
    }

    /**
     * @Route("/", name="perfil_index", methods={"GET"})
     */
    public function index(): Response
    {
        $perfis = $this->perfilRepository->findAll();
        return $this->json($perfis);
    }

    /**
     * @Route("/new", name="perfil_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $perfil = new Perfil(
            $data['id_usuario'],
            $data['interesse_aventura'],
            $data['interesse_cultura'],
            $data['interesse_gastronomia'],
            $data['orcamento_diario'],
            $data['duracao_viagem'],
            $data['outros_interesses']
        );

        $this->perfilRepository->add($perfil, true);

        return $this->json([
            'status' => 'Perfil criado com sucesso!',
            'perfil' => $perfil,
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}", name="perfil_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $perfil = $this->perfilRepository->find($id);

        if (!$perfil) {
            return $this->json(['error' => 'Perfil não encontrado.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($perfil);
    }

    /**
     * @Route("/{id}/edit", name="perfil_edit", methods={"PUT"})
     */
    public function edit(int $id, Request $request): Response
    {
        $perfil = $this->perfilRepository->find($id);

        if (!$perfil) {
            return $this->json(['error' => 'Perfil não encontrado.'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['id_usuario'])) {
            $perfil->setIdUsuario($data['id_usuario']);
        }
        if (isset($data['interesse_aventura'])) {
            $perfil->setInteresseAventura($data['interesse_aventura']);
        }
        if (isset($data['interesse_cultura'])) {
            $perfil->setInteresseCultura($data['interesse_cultura']);
        }
        if (isset($data['interesse_gastronomia'])) {
            $perfil->setInteresseGastronomia($data['interesse_gastronomia']);
        }
        if (isset($data['orcamento_diario'])) {
            $perfil->setOrcamentoDiario($data['orcamento_diario']);
        }
        if (isset($data['duracao_viagem'])) {
            $perfil->setDuracaoViagem($data['duracao_viagem']);
        }
        if (isset($data['outros_interesses'])) {
            $perfil->setOutrosInteresses($data['outros_interesses']);
        }

        $this->perfilRepository->add($perfil, true);

        return $this->json([
            'status' => 'Perfil atualizado com sucesso!',
            'perfil' => $perfil,
        ]);
    }

    /**
     * @Route("/{id}", name="perfil_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $perfil = $this->perfilRepository->find($id);

        if (!$perfil) {
            return $this->json(['error' => 'Perfil não encontrado.'], Response::HTTP_NOT_FOUND);
        }

        $this->perfilRepository->remove($perfil, true);

        return $this->json(['status' => 'Perfil removido com sucesso!']);
    }

    /**
     * @Route("/search", name="perfil_search", methods={"POST"})
     */
    public function search(Request $request): Response
    {
        $criteria = json_decode($request->getContent(), true);

        $perfis = $this->perfilRepository->findByCriteria($criteria);

        return $this->json($perfis);
    }
}
