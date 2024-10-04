<?php

namespace App\Entity;

use App\Repository\HospedagemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HospedagemRepository::class)]
#[ORM\Table(name: 'hospedagens')]
class Hospedagem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_hospedagem')]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nome = null;

    #[ORM\Column(length: 100)]
    private ?string $destino = null;

    #[ORM\Column(length: 50)]
    private ?string $tipo = null;

    #[ORM\Column]
    private ?float $custo_por_noite = null;

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

    public function getDestino(): ?string
    {
        return $this->destino;
    }

    public function setDestino(string $destino): static
    {
        $this->destino = $destino;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getCustoPorNoite(): ?float
    {
        return $this->custo_por_noite;
    }

    public function setCustoPorNoite(float $custo_por_noite): static
    {
        $this->custo_por_noite = $custo_por_noite;

        return $this;
    }
}
