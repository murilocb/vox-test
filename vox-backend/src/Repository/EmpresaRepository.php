<?php

namespace App\Repository;

use App\Entity\Empresa;
use App\Entity\Socio; // Adicione o uso da entidade Socio
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Empresa>
 */
class EmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empresa::class);
    }

    /**
     * @return Empresa[] Returns an array of Empresa objects
     */
    public function findByName(string $name): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.name = :name')
            ->setParameter('name', $name)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Empresa[] Returns an array of Empresa objects
     */
    public function findByFilters(array $filters): array
    {
        $queryBuilder = $this->createQueryBuilder('e');

        if (isset($filters['name'])) {
            $queryBuilder->andWhere('e.name = :name')
                ->setParameter('name', $filters['name']);
        }

        if (isset($filters['status'])) {
            $queryBuilder->andWhere('e.status = :status')
                ->setParameter('status', $filters['status']);
        }

        return $queryBuilder
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Socio[] Returns an array of Socio objects associated with the given empresaId
     */
    public function findSociosByEmpresaId(int $empresaId): array
    {
        $entityManager = $this->getEntityManager();
        
        // Crie um QueryBuilder para buscar os sócios associados à empresa
        $queryBuilder = $entityManager->createQueryBuilder()
            ->select('s')
            ->from(Socio::class, 's')
            ->join('s.empresa', 'e')
            ->where('e.id = :empresaId')
            ->setParameter('empresaId', $empresaId);

        return $queryBuilder->getQuery()->getResult();
    }

    public function add(Empresa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Empresa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
