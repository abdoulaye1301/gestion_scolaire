<?php

namespace App\Repository;

use App\Entity\EtatCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtatCours>
 *
 * @method EtatCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatCours[]    findAll()
 * @method EtatCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatCours::class);
    }

//    /**
//     * @return EtatCours[] Returns an array of EtatCours objects
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

//    public function findOneBySomeField($value): ?EtatCours
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
