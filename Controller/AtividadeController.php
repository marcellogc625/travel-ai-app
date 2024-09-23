<?php

namespace App\Controller;

use App\Entity\Atividade;
use App\Repository\AtividadeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtividadeController extends AbstractController{
    #[Route('/atividade/criar', name: 'atividade_criar')]
    public function criar(AtividadeRepository $AtividadeRepository): Response {
        // Criar uma nova instância de Produto
        $atividade = new Atividade("Caminhada na Montanha","Uma atividade de caminhada ao ar livre com belas vistas.",
"Serra da Mantiqueira","Aventura",250.00);
        
        // Usar o método add do repositório para persistir
        $AtividadeRepository -> add($atividade, true); // O segundo parâmetro 'true' faz o flush imediatamente

        return new Response('Atividade criado via Repository com ID ' . $atividade->getId());
    }

    

}