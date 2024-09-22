<?php

namespace App\Repository;

use App\Entity\Destino;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Destino>
 */
class DestinoRepository extends ServiceEntityRepository {
    private EntityManagerInterface $entityManager;

    // Injetar o EntityManager via construtor
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Destino::class);
        $this->entityManager = $entityManager;
    }

    // Método para adicionar um Destino
    public function add(Destino $destino, bool $flush = false): void
    {
        $this->entityManager->persist($destino);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    public function remove(Destino $destino, bool $flush = false): void
    {
        $this->entityManager->remove($destino);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Encontra destinos pelo nome
     *
     * @param string $nome
     * @return Destino[] Retorna um array de objetos Destino
     */

    public function findByNome(string $nome): array {
        return $this->createQueryBuilder('d')
            ->andWhere('d.nome LIKE :nome')
            ->setParameter('nome', '%' . $nome . '%')
            ->orderBy('d.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra destinos pelo país
     *
     * @param string $pais
     * @return Destino[] Retorna um array de objetos Destino
     */

    public function findByPais(string $pais): array {
        return $this->createQueryBuilder('d')
            ->andWhere('d.pais = :pais')
            ->setParameter('pais', $pais)
            ->orderBy('d.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra destinos pela cidade
     *
     * @param string $cidade
     * @return Destino[] Retorna um array de objetos Destino
     */

    public function findByCidade(string $cidade): array {
        return $this->createQueryBuilder('d')
            ->andWhere('d.cidade LIKE :cidade')
            ->setParameter('cidade', '%' . $cidade . '%')
            ->orderBy('d.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }
    
    
}
