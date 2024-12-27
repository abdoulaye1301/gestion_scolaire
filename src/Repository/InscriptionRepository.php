<?php

namespace App\Repository;

use App\Entity\Inscription;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Inscription>
 *
 * @method Inscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscription[]    findAll()
 * @method Inscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionRepository extends ServiceEntityRepository
{
    public const PAGINATION_PAR_PAGE = 10;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscription::class);
    }


    /**
     * @return int/mixed/string/null
     * @throws \Doctrine\ORM\NonUniqueResultException 
     */
    public function countAllElevesInscris()
    {
        $queryBuilder = $this->createQueryBuilder(alias: 'i');
        $queryBuilder->select(select: 'COUNT(i.id) as valeur');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @return Inscription[] Returns an array of Inscription objects
     */
    public function finAllAdministration(): array
    {
        return $this->createQueryBuilder('i')
            ->orderBy('i.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function finAllInscriptions($offset): Paginator
    {
        $query = $this->createQueryBuilder('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(self::PAGINATION_PAR_PAGE)
            ->setFirstResult($offset)
            ->getQuery();
        return new Paginator($query);
    }
    //    /**
    //     * @return Inscription[] Returns an array of Inscription objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Inscription
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
