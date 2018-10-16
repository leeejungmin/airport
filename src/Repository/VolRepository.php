<?php

namespace App\Repository;

use App\Entity\Volfake;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vol[]    findAll()
 * @method Vol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Volfake::class);
    }

//    /**
//     * @return Vol[] Returns an array of Vol objects
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
    public function volsituation($price): array
  {
      $conn = $this->getEntityManager()->getConnection();
      $sql = 'SELECT volnum, COUNT(volnum) from Vol GROUP BY volnum';

      $stmt = $conn->prepare($sql);
      $stmt->execute();

      // returns an array of arrays (i.e. a raw data set)
      return $stmt->fetchAll();
  }
}

//
// $sql = '
//     SELECT name,
//       COUNT(CASE WHEN volnum="FR1" THEN 1 END),
//       COUNT(CASE WHEN volnum="FR2" THEN 1 END),
//       COUNT(CASE WHEN volnum="FR3" THEN 1 END)
//     FROM Vol
//     GROUP BY name
//     ';
