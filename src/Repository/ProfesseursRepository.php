<?php

namespace App\Repository;

use App\Entity\Professeurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Professeurs>
 *
 * @method Professeurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Professeurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Professeurs[]    findAll()
 * @method Professeurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfesseursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Professeurs::class);
    }

    /**
     * @return int/mixed/string/null
     * @throws \Doctrine\ORM\NonUniqueResultException 
     */
    public function CountAllProfesseurs()
    {
        $queryBuilder = $this->createQueryBuilder(alias: 'P');
        $queryBuilder->select(select: 'COUNT(P.id) as value');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
    //    /**
    //     * @return Professeurs[] Returns an array of Professeurs objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Professeurs
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
