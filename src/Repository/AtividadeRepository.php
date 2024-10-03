<?php

namespace App\Repository;

use App\Entity\Atividade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Atividade>
 */
class AtividadeRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    // Injetar o EntityManager via construtor
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Atividade::class);
        $this->entityManager = $entityManager;
    }

    // Método para adicionar um Atividade
    public function add(Atividade $atividade, bool $flush = false): void
    {

        $this->entityManager->persist($atividade);

        if ($flush) {
            $this->entityManager->flush();
        }
    }

    // Método para remover um Atividade
    public function remove(Atividade $atividade, bool $flush = true): void
    {

        $this->entityManager->remove($atividade);

        if ($flush) {
            $this->entityManager->flush();
            var_dump('flush foi executado');
        }
    }

    /**
     * Encontra atividades pelo nome
     *
     * @param string $nome
     * @return Atividade[] Returns an array of Atividade objects
     */
    public function findByNome(string $nome): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.nome LIKE :nome')
            ->setParameter('nome', '%' . $nome . '%')
            ->orderBy('a.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra atividades com base em critérios dinâmicos
     *
     * @param array $criteria
     * @return Atividade[] Returns an array of Atividade objects
     */

    public function findByCriteria(array $criteria): array
    {
        $qb = $this->createQueryBuilder('a');

        if (isset($criteria['nome'])) {
            $qb->andWhere('a.nome LIKE :nome')
                ->setParameter('nome', '%' . $criteria['nome'] . '%');
        }

        if (isset($criteria['categoria'])) {
            $qb->andWhere('a.categoria = :categoria')
                ->setParameter('categoria', $criteria['categoria']);
        }

        if (isset($criteria['destino'])) {
            $qb->andWhere('a.destino LIKE :destino')
                ->setParameter('destino', '%' . $criteria['destino'] . '%');
        }

        if (isset($criteria['custo_min'])) {
            $qb->andWhere('a.custo_estimado >= :custo_min')
                ->setParameter('custo_min', $criteria['custo_min']);
        }

        if (isset($criteria['custo_max'])) {
            $qb->andWhere('a.custo_estimado <= :custo_max')
                ->setParameter('custo_max', $criteria['custo_max']);
        }

        return $qb->orderBy('a.nome', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
