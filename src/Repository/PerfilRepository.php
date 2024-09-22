<?php

namespace App\Repository;

use App\Entity\Perfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Perfil>
 */
class PerfilRepository extends ServiceEntityRepository {
    private EntityManagerInterface $entityManager;

    // Injetar o EntityManager via construtor
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Perfil::class);
        $this->entityManager = $entityManager;
    }

    // Método para adicionar um Perfil
    public function add(Perfil $perfil, bool $flush = false): void
    {
        $this->entityManager->persist($perfil);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Remove um Perfil
     *
     * @param Perfil $perfil
     * @param bool $flush
     */
    public function remove(Perfil $perfil, bool $flush = false): void
    {
        $this->entityManager->remove($perfil);
        
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Encontra perfis pelo ID do usuário
     *
     * @param int $id_usuario
     * @return Perfil[] Retorna um array de objetos Perfil
     */
    public function findByUsuario(int $id_usuario): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id_usuario = :id_usuario')
            ->setParameter('id_usuario', $id_usuario)
            ->orderBy('p.orcamento_diario', 'DESC') // Exemplo de ordenação
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra perfis pelo interesse em aventura
     *
     * @param int $interesse_aventura
     * @return Perfil[] Retorna um array de objetos Perfil
     */
    public function findByInteresseAventura(int $interesse_aventura): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.interesse_aventura = :interesse_aventura')
            ->setParameter('interesse_aventura', $interesse_aventura)
            ->orderBy('p.orcamento_diario', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra perfis pelo interesse em cultura
     *
     * @param int $interesse_cultura
     * @return Perfil[] Retorna um array de objetos Perfil
     */
    public function findByInteresseCultura(int $interesse_cultura): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.interesse_cultura = :interesse_cultura')
            ->setParameter('interesse_cultura', $interesse_cultura)
            ->orderBy('p.orcamento_diario', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra perfis pelo interesse em gastronomia
     *
     * @param int $interesse_gastronomia
     * @return Perfil[] Retorna um array de objetos Perfil
     */
    
    public function findByInteresseGastronomia(int $interesse_gastronomia): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.interesse_gastronomia = :interesse_gastronomia')
            ->setParameter('interesse_gastronomia', $interesse_gastronomia)
            ->orderBy('p.orcamento_diario', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra perfis com orçamento diário entre um intervalo
     *
     * @param float $min
     * @param float $max
     * @return Perfil[] Retorna um array de objetos Perfil
     */
    public function findByOrcamentoDiarioRange(float $min, float $max): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.orcamento_diario BETWEEN :min AND :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('p.orcamento_diario', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra perfis com duração de viagem entre um intervalo
     *
     * @param int $min
     * @param int $max
     * @return Perfil[] Retorna um array de objetos Perfil
     */
    public function findByDuracaoViagemRange(int $min, int $max): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.duracao_viagem BETWEEN :min AND :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('p.duracao_viagem', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra perfis por outros interesses
     *
     * @param string $outros_interesses
     * @return Perfil[] Retorna um array de objetos Perfil
     */

    public function findByOutrosInteresses(string $outros_interesses): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.outros_interesses LIKE :outros_interesses')
            ->setParameter('outros_interesses', '%' . $outros_interesses . '%')
            ->orderBy('p.orcamento_diario', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Encontra perfis com base em critérios dinâmicos
     *
     * @param array $criteria
     * @return Perfil[] Retorna um array de objetos Perfil
     */

    public function findByCriteria(array $criteria): array {
        $qb = $this->createQueryBuilder('p');

        if (isset($criteria['id_usuario'])) {
            $qb->andWhere('p.id_usuario = :id_usuario')
               ->setParameter('id_usuario', $criteria['id_usuario']);
        }

        if (isset($criteria['interesse_aventura'])) {
            $qb->andWhere('p.interesse_aventura = :interesse_aventura')
               ->setParameter('interesse_aventura', $criteria['interesse_aventura']);
        }

        if (isset($criteria['interesse_cultura'])) {
            $qb->andWhere('p.interesse_cultura = :interesse_cultura')
               ->setParameter('interesse_cultura', $criteria['interesse_cultura']);
        }

        if (isset($criteria['interesse_gastronomia'])) {
            $qb->andWhere('p.interesse_gastronomia = :interesse_gastronomia')
               ->setParameter('interesse_gastronomia', $criteria['interesse_gastronomia']);
        }

        if (isset($criteria['orcamento_min'])) {
            $qb->andWhere('p.orcamento_diario >= :orcamento_min')
               ->setParameter('orcamento_min', $criteria['orcamento_min']);
        }

        if (isset($criteria['orcamento_max'])) {
            $qb->andWhere('p.orcamento_diario <= :orcamento_max')
               ->setParameter('orcamento_max', $criteria['orcamento_max']);
        }

        if (isset($criteria['duracao_min'])) {
            $qb->andWhere('p.duracao_viagem >= :duracao_min')
               ->setParameter('duracao_min', $criteria['duracao_min']);
        }

        if (isset($criteria['duracao_max'])) {
            $qb->andWhere('p.duracao_viagem <= :duracao_max')
               ->setParameter('duracao_max', $criteria['duracao_max']);
        }

        if (isset($criteria['outros_interesses'])) {
            $qb->andWhere('p.outros_interesses LIKE :outros_interesses')
               ->setParameter('outros_interesses', '%' . $criteria['outros_interesses'] . '%');
        }

        // Adicione outros filtros conforme necessário

        return $qb->orderBy('p.orcamento_diario', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

}
