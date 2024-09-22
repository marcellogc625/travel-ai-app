<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
#[ORM\Table(name: 'perfis')]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\OneToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: 'id_usuario', referencedColumnName: 'id', nullable: false)]
    private ?int $id_usuario = null;

    #[ORM\Column]
    private ?int $interesse_aventura = null;

    #[ORM\Column]
    private ?int $interesse_cultura = null;

    #[ORM\Column]
    private ?int $interesse_gastronomia = null;

    #[ORM\Column]
    private ?float $orcamento_diario = null;

    #[ORM\Column]
    private ?int $duracao_viagem = null;

    #[ORM\Column(length: 255)]
    private ?string $outros_interesses = null;

    public function __construct(int $id_usuario, int $interesse_aventura, int $interesse_cultura, int $interesse_gastronomia, float $orcamento_diario, int $duracao_viagem, String $outros_interesses){
        $this -> id_usuario = $id_usuario;
        $this -> interesse_aventura = $interesse_aventura;
        $this -> interesse_cultura = $interesse_cultura;
        $this -> interesse_gastronomia = $interesse_gastronomia;
        $this -> orcamento_diario = $orcamento_diario;
        $this -> duracao_viagem = $duracao_viagem;
        $this -> outros_interesses = $outros_interesses;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuario(): ?int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): static
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getInteresseAventura(): ?int
    {
        return $this->interesse_aventura;
    }

    public function setInteresseAventura(int $interesse_aventura): static
    {
        $this->interesse_aventura = $interesse_aventura;

        return $this;
    }

    public function getInteresseCultura(): ?int
    {
        return $this->interesse_cultura;
    }

    public function setInteresseCultura(int $interesse_cultura): static
    {
        $this->interesse_cultura = $interesse_cultura;

        return $this;
    }

    public function getInteresseGastronomia(): ?int
    {
        return $this->interesse_gastronomia;
    }

    public function setInteresseGastronomia(int $interesse_gastronomia): static
    {
        $this->interesse_gastronomia = $interesse_gastronomia;

        return $this;
    }

    public function getOrcamentoDiario(): ?float
    {
        return $this->orcamento_diario;
    }

    public function setOrcamentoDiario(float $orcamento_diario): static
    {
        $this->orcamento_diario = $orcamento_diario;

        return $this;
    }

    public function getDuracaoViagem(): ?int
    {
        return $this->duracao_viagem;
    }

    public function setDuracaoViagem(int $duracao_viagem): static
    {
        $this->duracao_viagem = $duracao_viagem;

        return $this;
    }

    public function getOutrosInteresses(): ?string
    {
        return $this->outros_interesses;
    }

    public function setOutrosInteresses(string $outros_interesses): static
    {
        $this->outros_interesses = $outros_interesses;

        return $this;
    }
}
