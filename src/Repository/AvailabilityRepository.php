<?php

namespace App\Repository;

use App\Entity\Service;
use App\Entity\Availability;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Availability|null find($id, $lockMode = null, $lockVersion = null)
 * @method Availability|null findOneBy(array $criteria, array $orderBy = null)
 * @method Availability[]    findAll()
 * @method Availability[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvailabilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Availability::class);
    }

    // /**
    //  * @return Availability[] Returns an array of Availability objects
    //  */
    public function findByBarber($barber)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT a
            FROM availability
            WHERE barber_id = :id'
        )->setParameter('id', $barber);

        return $query->getResult();
    }

     // /**
    //  * @return Availability[] Returns an array of Availability objects
    //  */
    public function findAllByWeek($service)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT a FROM App\Entity\Availability a 
                WHERE a NOT IN 
                (
                    SELECT a FROM App\Entity\Appointment app 
                    WHERE a MEMBER OF app.availabilities 
                    AND app.date BETWEEN CURRENT_DATE() AND CURRENT_DATE()+6
                )
                AND a IN 
                (
                    SELECT DISTINCT a FROM App\Entity\Barber b 
                    WHERE a MEMBER OF b.availabilities
                    AND :s MEMBER OF b.services
                )'
        )->setParameter(':s', $service);

        return $query->getResult();
    }

    // /**
    //  * @return Availability[] Returns an array of Availability objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Availability
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
