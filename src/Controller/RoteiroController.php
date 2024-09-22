<?php

namespace App\Controller;

use App\Entity\Roteiro;
use App\Repository\RoteiroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RoteiroController extends AbstractController{
    
    #[Route('/roteiro/criar', name: 'roteiro_criar')]
    public function criar(RoteiroRepository $RoteiroRepository): Response
    {
        // Criar uma nova instância de Produto
        $roteiro = new Roteiro(
            1,                                     // id_usuario
            1,                                     // id_destino
            new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo')),   // data_criacao
            "Roteiro de 7 dias explorando as principais atrações de Cabo Frio.", // descricao
            [                                      // dias (array com as atividades por dia)
                "Dia 1: Chegada e passeio na Praia do Forte",
                "Dia 2: Visita à Ilha do Japonês",
                "Dia 3: City tour histórico",
                "Dia 4: Mergulho nas águas cristalinas",
                "Dia 5: Passeio de barco pelas ilhas",
                "Dia 6: Compras no centro da cidade",
                "Dia 7: Dia livre para descanso"
            ]
        );
        
        // Usar o método add do repositório para persistir
        $RoteiroRepository->add($roteiro, true); // O segundo parâmetro 'true' faz o flush imediatamente

        return new Response('Roteiro criado via Repository com ID ' . $roteiro->getId());
    }

    #[Route('/roteiro/lista', name: 'roteiro_lista')]
    public function lista(RoteiroRepository $roteiroRepository): Response {
        // Obtém todos os roteiros do banco de dados
        $roteiros = $roteiroRepository->findAll();

        // Renderiza uma lista de roteiros com um formulário para deletar
        return $this->render('roteiro/lista.html.twig', [
            'roteiros' => $roteiros
        ]);
    }

    #[Route('/roteiro/deletar', name: 'roteiro_deletar', methods: ['POST'])]
    public function deletar(Request $request, RoteiroRepository $roteiroRepository, EntityManagerInterface $entityManager): Response
    {
        // Obtém o ID do roteiro enviado pelo formulário
        $roteiroId = $request->request->get('roteiro_id');
    
        // Encontra o roteiro no banco de dados
        $roteiro = $roteiroRepository->find($roteiroId);
    
        if ($roteiro) {
            // Remove o roteiro do banco de dados
            $entityManager->remove($roteiro);
            $entityManager->flush();
    
            $this->addFlash('success', 'Roteiro deletado com sucesso!');
        } else {
            $this->addFlash('error', 'Roteiro não encontrado!');
        }
    
        // Redireciona para a página de lista de roteiros
        return $this->redirectToRoute('roteiro_lista');
    }

    #[Route('/roteiro/deletar-selecao', name: 'roteiro_deletar_selecao')]
    public function deletarSelecao(RoteiroRepository $roteiroRepository): Response
    {
        // Busca todos os roteiros disponíveis no banco de dados
        $roteiros = $roteiroRepository->findAll();

        // Renderiza o template com o formulário de seleção
        return $this->render('roteiro/deletar.html.twig', [
            'roteiros' => $roteiros
        ]);
    }

}