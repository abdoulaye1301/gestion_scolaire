<?php

namespace App\Repository;

use App\Entity\Devoir;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Devoir>
 *
 * @method Devoir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devoir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devoir[]    findAll()
 * @method Devoir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevoirRepository extends ServiceEntityRepository
{
    public const PAGINATION_PAR_PAGE = 10;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devoir::class);
    }

    /**
     * @return int/mixed/string/null
     * @throws \Doctrine\ORM\NonUniqueResultException 
     */
    public function findByDevoirs($offset): Paginator
    {
        $query = $this->createQueryBuilder('d')
            ->orderBy('d.id', 'DESC')
            ->setMaxResults(self::PAGINATION_PAR_PAGE)
            ->setFirstResult($offset)
            ->getQuery();
        return new Paginator($query);
    }

    //    /**
    //     * @return Devoir[] Returns an array of Devoir objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Devoir
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
