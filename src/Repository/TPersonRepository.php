<?php

namespace App\Repository;

use App\Entity\TPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TPerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method TPerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method TPerson[]    findAll()
 * @method TPerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TPersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TPerson::class);
    }

    // /**
    //  * @return TPerson[] Returns an array of TPerson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TPerson
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
