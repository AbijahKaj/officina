<?php

namespace App\Repository;

use App\Entity\Office;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Office|null find($id, $lockMode = null, $lockVersion = null)
 * @method Office|null findOneBy(array $criteria, array $orderBy = null)
 * @method Office[]    findAll()
 * @method Office[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Office::class);
    }

    /**
     * @param $uid
     * @return Office[] Returns an array of Office objects
     */
    public function findAllByOwner($uid)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.user = :val')
            ->addOrderBy('o.id', 'DESC')
            ->setParameter('val', $uid)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $query
     * @param int $limit
     * @return Office[] Returns an array of Office objects
     */
    public function findAllMatching(string $query, int $limit = 5)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.location LIKE :query')
            ->orWhere('o.name LIKE :query')
            ->addOrderBy('o.price', 'DESC')
            ->setParameter('query', '%'.$query.'%')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getPriceRange()
    {
        return $this->createQueryBuilder('o')
            ->select('o.price')
            ->groupBy('o.price')
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Office[] Returns an array of Office objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Office
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
