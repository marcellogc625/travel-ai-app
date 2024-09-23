<?php

namespace App\Controller;

use App\Entity\Hospedagem;
use App\Repository\HospedagemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HospedagemController extends AbstractController
{
    #[Route('/hospedagem/criar', name: 'hospedagem_criar')]
    public function criar(HospedagemRepository $hospedagemRepository): Response
    {
        // Criar uma nova instância de Produto
        $hospedagem = new Hospedagem(
            "Hotel Fazenda Vista Alegre",
            "Campos do Jordão",
            "Hotel Fazenda",
            350.00
        );
        
        // Usar o método add do repositório para persistir
        $hospedagemRepository->add($hospedagem, true); // O segundo parâmetro 'true' faz o flush imediatamente

        return new Response('Hospedagem criada via Repository com ID ' . $hospedagem->getId());
    }

}