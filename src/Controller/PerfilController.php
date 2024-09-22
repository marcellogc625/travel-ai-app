<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Repository\PerfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    #[Route('/perfil/criar', name: 'perfil_criar')]
    public function criar(PerfilRepository $PerfilRepository): Response
    {
        // Criar uma nova instância de Produto
        $perfil = new Perfil(
            1,                // id_usuario
            5,                // interesse_aventura (por exemplo, em uma escala de 1 a 5)
            3,                // interesse_cultura
            4,                // interesse_gastronomia
            150.00,          // orcamento_diario
            7,                // duracao_viagem (em dias)
            "História, natureza" // outros_interesses
        );
        
        // Usar o método add do repositório para persistir
        $PerfilRepository->add($perfil, true); // O segundo parâmetro 'true' faz o flush imediatamente

        return new Response('Perfil criado via Repository com ID ' . $perfil->getId());
    }

}