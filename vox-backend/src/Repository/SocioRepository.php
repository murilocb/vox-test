<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Socio>
 */
class SocioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Socio::class);
    }

    /**
     * @return Socio[] Returns an array of Socio objects
     */
    public function findByEmpresa(int $empresaId): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.empresa = :empresaId')
            ->setParameter('empresaId', $empresaId)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function add(Socio $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Socio $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
