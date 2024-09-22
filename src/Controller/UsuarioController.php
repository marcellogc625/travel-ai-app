<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController {
    #[Route('/usuario/criar', name: 'usuario_criar')]
    public function criar(UsuarioRepository $UsuarioRepository): Response
    {
        // Criar uma nova instância de Produto
        $produto = new Usuario("John", "Doe", "johndoe1@gmail.com", "12345678", new \DateTimeImmutable('10-10-1987'));
        
        // Usar o método add do repositório para persistir
        $UsuarioRepository->add($produto, true); // O segundo parâmetro 'true' faz o flush imediatamente

        return new Response('Produto criado via Repository com ID ' . $produto->getId());
    }

}