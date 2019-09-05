<?php

namespace App\Repository;

use App\Entity\Datas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Datas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Datas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Datas[]    findAll()
 * @method Datas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Datas::class);
    }

//    public function findRendu1() {

//     return $this->createQueryBuilder('d')
//     ->select
//                 ->from('Datas', 'd')
//                 ->where ('d.rendu = ?1')
//                 ->getQuery()
//                 ->getResult();

//    }

} 
