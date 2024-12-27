<?php

namespace App\Repository;

use App\Entity\Emargement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emargement>
 *
 * @method Emargement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emargement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emargement[]    findAll()
 * @method Emargement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmargementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emargement::class);
    }

//    /**
//     * @return Emargement[] Returns an array of Emargement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Emargement
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
