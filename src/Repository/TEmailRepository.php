<?php

namespace App\Repository;

use App\Entity\TEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method TEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method TEmail[]    findAll()
 * @method TEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TEmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TEmail::class);
    }

    /*
      custom method everything() to query everything from all 3 tables/entities
    */

    public function everything(): array
    {
      return $this->createQueryBuilder('p')
            ->leftJoin('p.tMsgs', 'tMsgs')
            ->addSelect('tMsgs')
            ->leftJoin('p.tPeople', 'tpeople')
            ->addSelect('tpeople')
            ->getQuery()
            ->execute();
    }
    //  /**
    //   * @return TEmail[] Returns an array of TEmail objects
    //   */
   
    
    
    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('t')
    //         ->andWhere('t.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('t.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    

    
    
    
}
