<?php

namespace Tcc\TravelScriptGen\Entities;

class Destino{
    private int $id_destino;
    private String $nome;
    private String $pais;
    private String $cidade;
    private String $descricao;
    private String $imagem;

    public function __construct(int $id_destino, String $nome, String $pais, String $cidade, String $descricao, String $imagem){
        $this -> id_destino = $id_destino;
        $this -> nome = $nome;
        $this -> pais = $pais;
        $this -> cidade = $cidade;
        $this -> descricao = $descricao;
        $this -> imagem = $imagem;
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

    public function getNome(): String
    {
        return $this->nome;
    }

    public function setNome(String $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getPais(): String
    {
        return $this->pais;
    }

    public function setPais(String $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getCidade(): String
    {
        return $this->cidade;
    }

    public function setCidade(String $cidade): self
    {
        $this->cidade = $cidade;

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

    public function getImagem(): String
    {
        return $this->imagem;
    }

    public function setImagem(String $imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }
}

?>