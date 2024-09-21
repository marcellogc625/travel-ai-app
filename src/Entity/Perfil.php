<?php

namespace Tcc\TravelScriptGen\Entities;

class Perfil{

    private int $id_perfil;
    private int $id_usuario;
    private int $interesse_aventura;
    private int $interesse_cultura;
    private int $interesse_gastronomia;
    private float $orcamento_diario;
    private int $duracao_viagem;
    private String $outros_interesses;

    public function __construct(int $id_perfil, int $id_usuario, int $interesse_aventura, int $interesse_cultura, int $interesse_gastronomia, float $orcamento_diario, int $duracao_viagem, String $outros_interesses){
        $this -> id_perfil = $id_perfil;
        $this -> id_usuario = $id_usuario;
        $this -> interesse_aventura = $interesse_aventura;
        $this -> interesse_cultura = $interesse_cultura;
        $this -> interesse_gastronomia = $interesse_gastronomia;
        $this -> orcamento_diario = $orcamento_diario;
        $this -> duracao_viagem = $duracao_viagem;
        $this -> outros_interesses = $outros_interesses;
    }

    public function getIdPerfil(): int
    {
        return $this->id_perfil;
    }

    public function setIdPerfil(int $id_perfil): self
    {
        $this->id_perfil = $id_perfil;

        return $this;
    }

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getInteresseAventura(): int
    {
        return $this->interesse_aventura;
    }

    public function setInteresseAventura(int $interesse_aventura): self
    {
        $this->interesse_aventura = $interesse_aventura;

        return $this;
    }

    public function getInteresseCultura(): int
    {
        return $this->interesse_cultura;
    }

    public function setInteresseCultura(int $interesse_cultura): self
    {
        $this->interesse_cultura = $interesse_cultura;

        return $this;
    }

    public function getInteresseGastronomia(): int
    {
        return $this->interesse_gastronomia;
    }

    public function setInteresseGastronomia(int $interesse_gastronomia): self
    {
        $this->interesse_gastronomia = $interesse_gastronomia;

        return $this;
    }

    public function getOrcamentoDiario(): float
    {
        return $this->orcamento_diario;
    }

    public function setOrcamentoDiario(float $orcamento_diario): self
    {
        $this->orcamento_diario = $orcamento_diario;

        return $this;
    }

    public function getDuracaoViagem(): int
    {
        return $this->duracao_viagem;
    }

    public function setDuracaoViagem(int $duracao_viagem): self
    {
        $this->duracao_viagem = $duracao_viagem;

        return $this;
    }

    public function getOutrosInteresses(): String
    {
        return $this->outros_interesses;
    }

    public function setOutrosInteresses(String $outros_interesses): self
    {
        $this->outros_interesses = $outros_interesses;

        return $this;
    }

}

?>