<?php

declare(strict_types= 1);
namespace Tcc\TravelScriptGen\Entities;

class Roteiro {

    private int $id_roteiro;
    private int $id_usuario;
    private int $id_destino;
    private String $data_criacao;
    private String $destino;

    public function __construct(int $id_roteiro, int $id_usuario, int $id_destino, String $data_criacao, String $destino){
        $this -> id_roteiro = $id_roteiro;
        $this -> id_usuario = $id_usuario;
        $this -> id_destino = $id_destino;
        $this -> data_criacao = $data_criacao;
        $this -> destino = $destino;
    }

    public function getIdRoteiro(): int
    {
        return $this->id_roteiro;
    }

    public function setIdRoteiro(int $id_roteiro): self
    {
        $this->id_roteiro = $id_roteiro;

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

    public function getIdDestino(): int
    {
        return $this->id_destino;
    }

    public function setIdDestino(int $id_destino): self
    {
        $this->id_destino = $id_destino;

        return $this;
    }

    public function getDataCriacao(): String
    {
        return $this->data_criacao;
    }

    public function setDataCriacao(String $data_criacao): self
    {
        $this->data_criacao = $data_criacao;

        return $this;
    }

    public function getDestino(): String
    {
        return $this->destino;
    }

    public function setDestino(String $destino): self
    {
        $this->destino = $destino;

        return $this;
    }
}