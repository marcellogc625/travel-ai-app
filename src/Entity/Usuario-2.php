<?php

declare(strict_types= 1);
namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 */

class Usuario {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id_usuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private String $nome;

    /**
     * @ORM\Column(name="sobrenome", type="string", length=255)
     */
    private String $sobreNome; 

    /**
     * @ORM\Column(type="string", length=255)
     */
    private String $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private String $senha;

    /**
     * @ORM\Column(name="data_nascimento", type="date", length=255)
     */
    private DateTimeImmutable $nascimento;

    public function __construct(String $nome, String $sobreNome, String $email, String $senha, DateTimeImmutable $nascimento){
        $this -> nome = $nome;
        $this -> sobreNome = $sobreNome;
        $this -> email = $email;
        $this -> senha = $senha;
        $this -> nascimento = $nascimento;
    }

    public function getId(): int{ 
        return $this -> id_usuario;
    }
    
    public function setId(int $id_usuario) : void{
        $this -> id_usuario = $id_usuario;
    }

    public function getNome(): String{
        return $this -> nome;
    }

    public function setNome(String $nome): void{
        $this -> nome = $nome;
    }

    public function getSobreNome(): String{
        return $this -> sobreNome;
    }

    public function setSobreNome(String $sobreNome): void{
        $this -> sobreNome = $sobreNome;
    }

    public function getEmail(): String{
        return $this -> email;
    }

    public function setEmail(String $email): void{
        $this -> email = $email;
    }

    public function getSenha(): String{
        return $this -> senha;
    }

    public function setSenha(String $senha): void{
        $this -> senha = $senha;
    }

    public function getNascimento(): DateTimeImmutable{
        return $this -> nascimento;
    }

    public function setNascimento(DateTimeImmutable $nascimento): void{
        $this -> nascimento = $nascimento;
    }

    
}

?>