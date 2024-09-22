<?php

namespace App\Repository;

use App\Entity\Roteiro;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class RoteiroRepository extends ServiceEntityRepository {
    private EntityManagerInterface $entityManager;

    // Injetar o EntityManager via construtor
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Roteiro::class);
        $this->entityManager = $entityManager;
    }

    // Método para adicionar um Roteiro
    public function add(Roteiro $roteiro, bool $flush = false): void
    {
        $this->entityManager->persist($roteiro);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

        /**
     * Remove um Roteiro
     *
     * @param Roteiro $roteiro
     * @param bool $flush
     */
    public function remove(Roteiro $roteiro, bool $flush = false): void
    {
        $this->entityManager->remove($roteiro);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Encontra roteiros pelo ID do usuário
     *
     * @param int $id_usuario
     * @return Roteiro[] Retorna um array de objetos Roteiro
     */
    public function findByUsuario(int $id_usuario): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id_usuario = :id_usuario')
            ->setParameter('id_usuario', $id_usuario)
            ->orderBy('r.data_criacao', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra roteiros pelo ID do destino
     *
     * @param int $id_destino
     * @return Roteiro[] Retorna um array de objetos Roteiro
     */
    public function findByDestino(int $id_destino): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id_destino = :id_destino')
            ->setParameter('id_destino', $id_destino)
            ->orderBy('r.data_criacao', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra roteiros criados em uma data específica
     *
     * @param \DateTimeImmutable $data_criacao
     * @return Roteiro[] Retorna um array de objetos Roteiro
     */
    public function findByDataCriacao(\DateTimeImmutable $data_criacao): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.data_criacao = :data_criacao')
            ->setParameter('data_criacao', $data_criacao)
            ->orderBy('r.data_criacao', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
