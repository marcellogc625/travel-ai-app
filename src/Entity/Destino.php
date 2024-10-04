<?php

namespace App\Entity;

use App\Repository\DestinoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinoRepository::class)]
#[ORM\Table(name: 'destinos')]
class Destino
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_destino')]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nome = null;

    #[ORM\Column(length: 100)]
    private ?string $pais = null;

    #[ORM\Column(length: 100)]
    private ?string $cidade = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column(length: 255)]
    private ?string $imagem = null;

    public function __construct() {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): static
    {
        $this->pais = $pais;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): static
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getImagem(): ?string
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem): static
    {
        $this->imagem = $imagem;

        return $this;
    }
}
