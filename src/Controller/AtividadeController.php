<?php

namespace App\Controller;

use App\Entity\Atividade;
use App\Form\AtividadeType;
use App\Repository\AtividadeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// Importação de rotas com atributos (Symfony 5.2+)
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/atividade/", name="atividade_show")
 */
class AtividadeController extends AbstractController {
    private AtividadeRepository $atividadeRepository;

    public function __construct(AtividadeRepository $atividadeRepository)
    {
        $this->atividadeRepository = $atividadeRepository;
    }

    /**
     * @Route("/", name="atividade_index", methods={"GET"})
     */
    public function index(): Response
    {
        $atividades = $this->atividadeRepository->findAll();

        return $this->render('atividade/index.html.twig', [
            'atividades' => $atividades,
        ]);
    }

    /**
     * @Route("/new", name="atividade_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $atividade = new Atividade();
        $form = $this->createForm(AtividadeType::class, $atividade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->atividadeRepository->add($atividade, true);

            return $this->redirectToRoute('atividade_index');
        }

        return $this->render('atividade/new.html.twig', [
            'atividade' => $atividade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/atividade/{id}", name="atividade_show", methods={"GET"})
     */
    public function show(Atividade $atividade): Response
    {
        // Aqui você pode manipular a entidade $atividade
        return $this->render('atividade/show.html.twig', [
            'atividade' => $atividade,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="atividade_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Atividade $atividade): Response
    {
        $form = $this->createForm(AtividadeType::class, $atividade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->atividadeRepository->add($atividade, true);

            return $this->redirectToRoute('atividade_index');
        }

        return $this->render('atividade/edit.html.twig', [
            'atividade' => $atividade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="atividade_delete", methods={"POST"})
     */
    public function delete(Request $request, Atividade $atividade): Response
    {
        if ($this->isCsrfTokenValid('delete'.$atividade->getId(), $request->request->get('_token'))) {
            $this->atividadeRepository->remove($atividade, true);
        }

        return $this->redirectToRoute('atividade_index');
    }

    /**
     * @Route("/buscar/nome", name="atividade_buscar_nome", methods={"GET"})
     */
    public function buscarPorNome(Request $request): Response
    {
        $nome = $request->query->get('nome');
        $atividades = $this->atividadeRepository->findByNome($nome);

        return $this->render('atividade/index.html.twig', [
            'atividades' => $atividades,
        ]);
    }

    /**
     * @Route("/buscar/categoria", name="atividade_buscar_categoria", methods={"GET"})
     */
    public function buscarPorCategoria(Request $request): Response
    {
        $categoria = $request->query->get('categoria');
        $atividades = $this->atividadeRepository->findByCategoria($categoria);

        return $this->render('atividade/index.html.twig', [
            'atividades' => $atividades,
        ]);
    }

    // Adicione outros métodos de busca conforme necessário
}
