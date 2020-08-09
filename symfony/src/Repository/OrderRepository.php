<?php

namespace App\Repository;

use App\Entity\Office;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * @return Order[] Returns an array of Order objects
     */
    public function findAllByOffice($office)
    {
        return $this->createQueryBuilder('o')
            ->where("o.office = :val")
            ->addOrderBy('o.id', 'DESC')
            ->setParameter('val', $office)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Order[] Returns an array of Order objects
     */
    public function findAllByOwner($uid)
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.office', 'off')
            ->where("off.user = :val")
            ->addOrderBy('o.id', 'DESC')
            ->setParameter('val', $uid)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Order[] Returns an array of Order objects
     */
    public function findAllByBookedUser($uid)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.booked_by = :val')
            ->addOrderBy('o.id', 'DESC')
            ->setParameter('val', $uid)
            ->getQuery()
            ->getResult();
    }

}
