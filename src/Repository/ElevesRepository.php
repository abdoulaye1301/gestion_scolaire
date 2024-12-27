<?php

namespace App\Repository;

use App\Entity\Eleves;
use App\Model\RechercheDonnee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Self_;

/**
 * @extends ServiceEntityRepository<Eleves>
 *
 * @method Eleves|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eleves|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eleves[]    findAll()
 * @method Eleves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElevesRepository extends ServiceEntityRepository
{
    public const PAGINATION_PAR_PAGE = 10;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eleves::class);
    }

    /**
     * @return int/mixed/string/null
     * @throws \Doctrine\ORM\NonUniqueResultException 
     */
    public function countAllEleves()
    {
        $queryBuilder = $this->createQueryBuilder(alias: 'E');
        $queryBuilder->select(select: 'COUNT(E.id) as value');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function countAllGarçon()
    {
        return $this->createQueryBuilder('e')
            ->select(select: 'COUNT(e.id) as value')
            ->where('e.Sexe = :Sexe')
            ->setParameter('Sexe', 'M')
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function countAllFilles()
    {
        return $this->createQueryBuilder('e')
            ->select(select: 'COUNT(e.id) as value')
            ->where('e.Sexe = :Sexe')
            ->setParameter('Sexe', 'F')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function countByClasse()
    {
        $query = $this->createQueryBuilder('E')
            ->select('E.IdClasse as id, COUNT(E.IdClasse) as compt')
            ->groupBy('id');
        return $query->getQuery()->getResult();
    }

    public function finAllEleves($offset): Paginator
    {
        $query = $this->createQueryBuilder('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(self::PAGINATION_PAR_PAGE)
            ->setFirstResult($offset)
            ->getQuery();
        return new Paginator($query);
    }

    /**
     * Get published posts thanks to Recherche Donnee value
     * @param RechercheDonnee $rechercheDonnee
     * @throws \Doctrine\ORM\NonUniqueResultException 
     */
    public function findByRecherche(RechercheDonnee $rechercheDonnee)
    {
        $posts = $this->createQueryBuilder('e')
            ->where('e.Prenom LIKE :Prenom')
            ->setParameter('Prenom', '$Prenom')
            ->orderBy('e.id', 'DESC');

        if (!empty($rechercheDonnee->q)) {
            $posts = $posts
                ->andWhere('e.Prenom LIKE :q')
                ->setParameter('q', "%{$rechercheDonnee->q}%");
        }

        $posts = $posts
            ->getQuery()
            ->getResult();
        return $posts;
    }
    //    /**
    //     * @return Eleves[] Returns an array of Eleves objects
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

    //    public function findOneBySomeField($value): ?Eleves
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
