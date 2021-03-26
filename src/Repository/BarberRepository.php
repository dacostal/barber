<?php

namespace App\Repository;

use App\Entity\Barber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Barber|null find($id, $lockMode = null, $lockVersion = null)
 * @method Barber|null findOneBy(array $criteria, array $orderBy = null)
 * @method Barber[]    findAll()
 * @method Barber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Barber::class);
    }

    // /**
    //  * @return Barber[] Returns an array of Barber objects
    //  */
    public function findByService($service)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT b FROM App\Entity\Barber b  WHERE :s MEMBER OF b.services'
        )->setParameter(':s', $service);

        return $query->getResult();
    }

    // /**
    //  * @return Barber[] Returns an array of Barber objects
    //  */

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Barber
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
