<?php

namespace App\Repository;

use App\Entity\Rhum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rhum|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rhum|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rhum[]    findAll()
 * @method Rhum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rhum::class);
    }

    // /**
    //  * @return Rhum[] Returns an array of Rhum objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rhum
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
