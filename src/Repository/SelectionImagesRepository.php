<?php

namespace App\Repository;

use App\Entity\SelectionImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SelectionImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectionImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectionImages[]    findAll()
 * @method SelectionImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectionImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectionImages::class);
    }

    // /**
    //  * @return SelectionImages[] Returns an array of SelectionImages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SelectionImages
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
