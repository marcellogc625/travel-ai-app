<?php

namespace App\Controller;

use App\Entity\Destino;
use App\Repository\DestinoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinoController extends AbstractController
{
    #[Route('/destino/criar', name: 'destino_criar')]
    public function criar(DestinoRepository $DestinoRepository): Response
    {
        // Criar uma nova instância de Produto
        $destino = new Destino(
            "Praia do Forte",                  // nome
            "Brasil",                          // pais
            "Cabo Frio",                       // cidade
            "Uma linda praia conhecida por suas águas claras e areia branca.", // descricao
            "https://pousadabrisadoforte.com.br/wp-content/uploads/2018/09/cabo-frioo-1216x800.jpg" // imagem (caminho da internet)
        );
        
        // Usar o método add do repositório para persistir
        $DestinoRepository->add($destino, true); // O segundo parâmetro 'true' faz o flush imediatamente

        return new Response('Destino criada via Repository com ID ' . $destino->getId());
    }

}