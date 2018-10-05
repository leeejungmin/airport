<?php

namespace App\Repository;

use App\Entity\Vollist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vollist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vollist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vollist[]    findAll()
 * @method Vollist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VollistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vollist::class);
    }

//    /**
//     * @return Vollist[] Returns an array of Vollist objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vollist
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
