<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Usuario>
 */
class UsuarioRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    // Injetar o EntityManager via construtor
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Usuario::class);
        $this->entityManager = $entityManager;
    }

    // Método para adicionar um Usuario
    public function add(Usuario $usuario, bool $flush = false): void
    {
        $this->entityManager->persist($usuario);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Remove um Usuario
     *
     * @param Usuario $usuario
     * @param bool $flush
     */
    public function remove(Usuario $usuario, bool $flush = false): void
    {
        $this->entityManager->remove($usuario);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Encontra um usuário pelo email
     *
     * @param string $email
     * @return Usuario|null Retorna um objeto Usuario ou null
     */
    public function findOneByEmail(string $email): ?Usuario
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Encontra usuários pelo nome
     *
     * @param string $nome
     * @return Usuario[] Retorna um array de objetos Usuario
     */
    public function findByNome(string $nome): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.nome LIKE :nome')
            ->setParameter('nome', '%' . $nome . '%')
            ->orderBy('u.sobrenome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra usuários pelo sobrenome
     *
     * @param string $sobrenome
     * @return Usuario[] Retorna um array de objetos Usuario
     */
    public function findBySobrenome(string $sobrenome): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.sobrenome LIKE :sobrenome')
            ->setParameter('sobrenome', '%' . $sobrenome . '%')
            ->orderBy('u.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra usuários com data de nascimento em um intervalo
     *
     * @param \DateTimeImmutable $data_inicio
     * @param \DateTimeImmutable $data_fim
     * @return Usuario[] Retorna um array de objetos Usuario
     */
    public function findByDataNascimentoRange(\DateTimeImmutable $data_inicio, \DateTimeImmutable $data_fim): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.data_nascimento BETWEEN :inicio AND :fim')
            ->setParameter('inicio', $data_inicio)
            ->setParameter('fim', $data_fim)
            ->orderBy('u.data_nascimento', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
