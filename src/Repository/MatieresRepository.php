<?php

namespace App\Repository;

use App\Entity\Matieres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Matieres>
 *
 * @method Matieres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matieres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matieres[]    findAll()
 * @method Matieres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatieresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matieres::class);
    }

    /**
     * @return int/mixed/string/null
     * @throws \Doctrine\ORM\NonUniqueResultException 
     */
    public function countAllMatieres()
    {
        $queryBuilder = $this->createQueryBuilder(alias: 'M');
        $queryBuilder->select(select: 'COUNT(M.id) as value');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    //    /**
    //     * @return Matieres[] Returns an array of Matieres objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Matieres
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
