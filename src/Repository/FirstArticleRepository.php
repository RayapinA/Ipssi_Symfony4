<?php

namespace App\Repository;

use App\Entity\FirstArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FirstArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method FirstArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method FirstArticle[]    findAll()
 * @method FirstArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FirstArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FirstArticle::class);
    }

    // /**
    //  * @return FirstArticle[] Returns an array of FirstArticle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FirstArticle
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
