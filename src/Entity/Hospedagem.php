<?php 

namespace Tcc\TravelScriptGen\Entities;

class Hospedagem{
    private int $id_hospedagem;
    private String $nome; 
    private String $destino;
    private String $tipo;
    private float $custo_noite;

    public function __construct(int $id_hospedagem, String $nome, String $destino, String $tipo, float $custo_noite){
        $this -> id_hospedagem = $id_hospedagem;
        $this -> nome = $nome;
        $this -> destino = $destino;
        $this -> tipo = $tipo;
        $this -> $custo_noite = $custo_noite;
    }

    public function getIdHospedagem(): int
    {
        return $this->id_hospedagem;
    }

    public function setIdHospedagem(int $id_hospedagem): self
    {
        $this->id_hospedagem = $id_hospedagem;

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

    public function getDestino(): String
    {
        return $this->destino;
    }

    public function setDestino(String $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getTipo(): String
    {
        return $this->tipo;
    }

    public function setTipo(String $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getCustoNoite(): float
    {
        return $this->custo_noite;
    }

    public function setCustoNoite(float $custo_noite): self
    {
        $this->custo_noite = $custo_noite;

        return $this;
    }
}

?>