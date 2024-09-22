<?php

namespace App\Repository;

use App\Entity\Hospedagem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Hospedagem>
 */
class HospedagemRepository extends ServiceEntityRepository {
    private EntityManagerInterface $entityManager;

    // Injetar o EntityManager via construtor
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Hospedagem::class);
        $this->entityManager = $entityManager;
    }

    // Método para adicionar um Hospedagem
    public function add(Hospedagem $hospedagem, bool $flush = false): void {
        $this->entityManager->persist($hospedagem);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Remove uma Hospedagem
     *
     * @param Hospedagem $hospedagem
     * @param bool $flush
     */
    public function remove(Hospedagem $hospedagem, bool $flush = false): void
    {
        $this->entityManager->remove($hospedagem);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Encontra hospedagens pelo destino
     *
     * @param string $destino
     * @return Hospedagem[] Retorna um array de objetos Hospedagem
     */
    public function findByDestino(string $destino): array
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.destino LIKE :destino')
            ->setParameter('destino', '%' . $destino . '%')
            ->orderBy('h.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra hospedagens pelo tipo
     *
     * @param string $tipo
     * @return Hospedagem[] Retorna um array de objetos Hospedagem
     */
    public function findByTipo(string $tipo): array
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.tipo = :tipo')
            ->setParameter('tipo', $tipo)
            ->orderBy('h.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra hospedagens com custo por noite entre um intervalo
     *
     * @param float $min
     * @param float $max
     * @return Hospedagem[] Retorna um array de objetos Hospedagem
     */

    public function findByCustoPorNoiteRange(float $min, float $max): array
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.custo_por_noite BETWEEN :min AND :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('h.custo_por_noite', 'ASC')
            ->getQuery()
            ->getResult();
    }

}
