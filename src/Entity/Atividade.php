<?php

namespace App\Entity;

use App\Repository\AtividadeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtividadeRepository::class)]
#[ORM\Table(name: 'atividades')]
class Atividade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column(length: 100)]
    private ?string $destino = null;

    #[ORM\Column(length: 50)]
    private ?string $categoria = null;

    #[ORM\Column]
    private ?float $custo_estimado = null;

    public function __construct(String $nome, String $descricao, String $destino, String $categoria, float $custo_estimado)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->destino = $destino;
        $this->categoria = $categoria;
        $this->custo_estimado = $custo_estimado;
    }

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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDestino(): ?string
    {
        return $this->destino;
    }

    public function setDestino(string $destino): static
    {
        $this->destino = $destino;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getCustoEstimado(): ?float
    {
        return $this->custo_estimado;
    }

    public function setCustoEstimado(float $custo_estimado): static
    {
        $this->custo_estimado = $custo_estimado;

        return $this;
    }
}
