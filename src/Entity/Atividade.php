<?php

namespace Tcc\TravelScriptGen\Entities;

class Atividade{
    private int $id_atividade;
    private String $nome;
    private String $descricao;
    private String $destino;
    private String $categoria;
    private float $custo_estimado;

    public function __construct(int $id_atividade, String $nome, String $descricao, String $destino, String $categoria, float $custo_estimado){
        $this -> id_atividade = $id_atividade;
        $this -> nome = $nome;
        $this -> descricao = $descricao;
        $this -> destino = $destino;
        $this -> categoria = $categoria; 
        $this -> custo_estimado = $custo_estimado;
    }

    public function getIdAtividade(): int
    {
        return $this->id_atividade;
    }

    public function setIdAtividade(int $id_atividade): self
    {
        $this->id_atividade = $id_atividade;

        return $this;
    }

    public function getNome(): String
    {
        return $this->nome;
    }

    public function setNome(String $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(): String
    {
        return $this->descricao;
    }

    public function setDescricao(String $descricao): self
    {
        $this->descricao = $descricao;

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

    public function getCategoria(): String
    {
        return $this->categoria;
    }

    public function setCategoria(String $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getCustoEstimado(): float
    {
        return $this->custo_estimado;
    }

    public function setCustoEstimado(float $custo_estimado): self
    {
        $this->custo_estimado = $custo_estimado;

        return $this;
    }
}

?>