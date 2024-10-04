<?php

namespace App\Entity;

use App\Repository\RoteiroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoteiroRepository::class)]
#[ORM\Table(name: 'roteiros')]
class Roteiro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_roteiro')]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\OneToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: 'id_usuario', referencedColumnName: 'id', nullable: false)]
    private ?int $id_usuario = null;

    #[ORM\Column]
    #[ORM\OneToOne(targetEntity: Destino::class)]
    #[ORM\JoinColumn(name: 'id_destino', referencedColumnName: 'id', nullable: false)]
    private ?int $id_destino = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $data_criacao = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column]
    private array $dias = [];

    public function __construct() {}

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

    public function getIdDestino(): ?int
    {
        return $this->id_destino;
    }

    public function setIdDestino(int $id_destino): static
    {
        $this->id_destino = $id_destino;

        return $this;
    }

    public function getDataCriacao(): ?\DateTimeImmutable
    {
        return $this->data_criacao;
    }

    public function setDataCriacao(\DateTimeImmutable $data_criacao): static
    {
        $this->data_criacao = $data_criacao;

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

    public function getDias(): array
    {
        return $this->dias;
    }

    public function setDias(array $dias): static
    {
        $this->dias = $dias;

        return $this;
    }
}
